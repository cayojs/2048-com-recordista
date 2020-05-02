function HTMLActuator() {
  this.tileContainer    = document.querySelector(".tile-container");
  this.scoreContainer   = document.querySelector(".score-container");
  this.bestContainer    = document.querySelector(".best-container");
  this.messageContainer = document.querySelector(".game-message");
  // COMENTADO this.sharingContainer = document.querySelector(".score-sharing");

  this.score = 0;
}

HTMLActuator.prototype.actuate = function (grid, metadata) {
  var self = this;

  window.requestAnimationFrame(function () {
    self.clearContainer(self.tileContainer);

    grid.cells.forEach(function (column) {
      column.forEach(function (cell) {
        if (cell) {
          self.addTile(cell);
        }
      });
    });

    self.updateScore(metadata.score);
    self.updateBestScore(metadata.bestScore);

    if (metadata.terminated) {
      if (metadata.over) {
        self.message(false); // You lose
      } else if (metadata.won) {
        self.message(true); // You win!
      }
    }

  });
};

// Continues the game (both restart and keep playing)
HTMLActuator.prototype.continueGame = function () {
  if (typeof gtag !== "undefined") {
    gtag("event", "restart", {
      event_category: "game",
    });
  }

  this.clearMessage();

};

HTMLActuator.prototype.clearContainer = function (container) {
  while (container.firstChild) {
    container.removeChild(container.firstChild);
  }
};

HTMLActuator.prototype.addTile = function (tile) {
  var self = this;

  var wrapper   = document.createElement("div");
  var inner     = document.createElement("div");
  var position  = tile.previousPosition || { x: tile.x, y: tile.y };
  var positionClass = this.positionClass(position);

  // We can't use classlist because it somehow glitches when replacing classes
  var classes = ["tile", "tile-" + tile.value, positionClass];

  if (tile.value > 2048) classes.push("tile-super");

  this.applyClasses(wrapper, classes);

  inner.classList.add("tile-inner");
  inner.textContent = tile.value;

  if (tile.previousPosition) {
    // Make sure that the tile gets rendered in the previous position first
    window.requestAnimationFrame(function () {
      classes[2] = self.positionClass({ x: tile.x, y: tile.y });
      self.applyClasses(wrapper, classes); // Update the position
    });
  } else if (tile.mergedFrom) {
    classes.push("tile-merged");
    this.applyClasses(wrapper, classes);

    // Render the tiles that merged
    tile.mergedFrom.forEach(function (merged) {
      self.addTile(merged);
    });
  } else {
    classes.push("tile-new");
    this.applyClasses(wrapper, classes);
  }

  // Add the inner part of the tile to the wrapper
  wrapper.appendChild(inner);

  // Put the tile on the board
  this.tileContainer.appendChild(wrapper);
};

HTMLActuator.prototype.applyClasses = function (element, classes) {
  element.setAttribute("class", classes.join(" "));
};

HTMLActuator.prototype.normalizePosition = function (position) {
  return { x: position.x + 1, y: position.y + 1 };
};

HTMLActuator.prototype.positionClass = function (position) {
  position = this.normalizePosition(position);
  return "tile-position-" + position.x + "-" + position.y;
};

//////////////////////////////////////////////////
////////// MONTA AS VARIÁVEIS PARA O AVISO QUE O RECORD FOI QUEBRADO
var melhorPontuacao = localStorage.getItem("bestScore");
var contador = 0;
$(document).ready(function(){
    $(".melhor-pontuacao b").text(melhorPontuacao);
});
//////////////////////////////////////////////////

HTMLActuator.prototype.updateScore = function (score) {
    this.clearContainer(this.scoreContainer);

    var difference = score - this.score;
    this.score = score;

    this.scoreContainer.textContent = this.score;

    if (difference > 0) {
        var addition = document.createElement("div");
        addition.classList.add("score-addition");
        addition.textContent = "+" + difference;

        this.scoreContainer.appendChild(addition);
    }

    //////////////////////////////////////////////////
    ////////// VERIFICA SE A PONTUAÇÃO É MAIOR QUE O RECORDE ATUAL, SE FOR MAIOR, A VARIÁVEL "CONTADOR" GANHA O VALOR "1"
    if(contador == 0 && this.score > melhorPontuacao){

        var d = new Date();
        var n = d.getTime();

        $.ajax({
            url : "record.txt?t="+n,
            dataType: "text",
            success : function (valorRecord){
                var valor_record = valorRecord;

                if(score > valorRecord){
                    contador = 1;

                    ////////// SE A VARIÁVEL "CONTADOR" FOR IGUAL A "1", O AVISO É DISPARADO
                    if(contador == 1){
                        $(document).ready(function(){
                            //alert("RECORD QUEBRADO!");
                            $(".record-quebrado").css("display", "flex");
                            setTimeout(function(){$(".record-quebrado").addClass("bounceOut");}, 3000);
                            setTimeout(function(){$(".record-quebrado").css("display", "none");}, 4000);

                            $(".parabens").fadeIn();
                            setTimeout(function(){$(".parabens").fadeOut();}, 3000);

                            $(".score-container").addClass("record-batido");
                            contador = 2;
                        });
                    }
                    //////////////////////////////////////////////////

                } else{
                    contador = 3;
                    $(document).ready(function(){

                        localStorage.setItem("bestScore", valorRecord);

                        ///// ESSE É O IF DE BAIXO... MIGREI PARA CÁ... E COMENTEI O DE BAIXO
                        // var recordAtualizado = localStorage.getItem("bestScore");
                        // var recordAtualizadoInteiro = parseInt(recordAtualizado);
                        //
                        // if(score > recordAtualizadoInteiro){
                        //     alert("RECORD QUEBRADO!!!");
                        //     $(".score-container").addClass("record-batido");
                        //     contador = 4;
                        // }
                        /////
                    });
                }
            }
        });
    }

    if(contador == 3){
        var recordAtualizado = localStorage.getItem("bestScore");
        var recordAtualizadoInteiro = parseInt(recordAtualizado);

        if(this.score >= recordAtualizadoInteiro){
            $(document).ready(function(){
                //alert("RECORD QUEBRADO!!!!!!!!!!!!!!!!!!");
                $(".record-quebrado").css("display", "flex");
                setTimeout(function(){$(".record-quebrado").addClass("bounceOut");}, 3000);
                setTimeout(function(){$(".record-quebrado").css("display", "none");}, 4000);

                $(".parabens").fadeIn();
                setTimeout(function(){$(".parabens").fadeOut();}, 3000);

                $(".score-container").addClass("record-batido");
                contador = 4;
            });
        }
    }

};

HTMLActuator.prototype.updateBestScore = function (bestScore) {
  this.bestContainer.textContent = bestScore;
};

HTMLActuator.prototype.message = function (won) {
  var type    = won ? "game-won" : "game-over";
  var message = won ? "VOCÊ GANHOU!" : "GAME OVER!";

  if (typeof gtag !== "undefined") {
    gtag("event", "end", {
      event_category: "game",
      event_label: type,
      value: this.score,
    });
  }

  this.messageContainer.classList.add(type);
  this.messageContainer.getElementsByTagName("p")[0].textContent = message;

  // COMENTADO this.clearContainer(this.sharingContainer);
  // COMENTADO this.sharingContainer.appendChild(this.scoreTweetButton());
  // COMENTADO twttr.widgets.load();

    localStorage.setItem("pontos", this.score);

    if(type == "game-over"){
        var pontos = localStorage.getItem("pontos");
        var record = localStorage.getItem("bestScore");

        var p = parseInt(pontos);
        var r = parseInt(record);

        var d = new Date();
        var n = d.getTime();

        $.ajax({
            url : "record.txt?t="+n,
            dataType: "text",
            success : function (data){
                var valor_record = data;

                if(p > data){
                    if(p >= r){
                        $(document).ready(function(){

                            $('p em').text(p);
                            localStorage.setItem("bestScore", p);
                            $('#novo_record').val(p);

                            //document.forms['formulario_record'].submit();

                            var formulario = $("#formulario_record");
                            var informacao = {"novo_record": formulario.find('[name=novo_record]').val()};
                            $.ajax({
                                url: 'https://www.cayojs.com.br/testes/2048/cadastra-novo-record.php',
                                type: 'POST',
                                data: informacao,
                                accept: 'application/json',
                                success: function(){

                                    $(".game-message .lower .retry-button").hide();

                                    setTimeout(function(){
                                        $(".popup-record").css("display", "flex");
                                        $(".popup-record form").append("<input id='nome_recordista' type='text' name='nome_recordista' placeholder='Deixe seu nome aqui...'maxlength='25'><input type='submit' value='SALVAR'>");
                                    }, 3000);

                                },
                                error: function(){
                                    alert('Erro ao Cadastrar o Record.');
                                }
                            });

                            return false;

                        });
                    }
                }
            }
        });
    }

};

HTMLActuator.prototype.clearMessage = function () {
  // IE only takes one value to remove at a time.
  this.messageContainer.classList.remove("game-won");
  this.messageContainer.classList.remove("game-over");
};

// COMENTADO HTMLActuator.prototype.scoreTweetButton = function () {
  // COMENTADO var tweet = document.createElement("a");
  // COMENTADO tweet.classList.add("twitter-share-button");
  // COMENTADO tweet.setAttribute("href", "https://twitter.com/share");
  // COMENTADO tweet.setAttribute("data-via", "cayojesse");
  // COMENTADO tweet.setAttribute("data-url", "#");
  // COMENTADO tweet.setAttribute("data-counturl", "#");
  // COMENTADO tweet.textContent = "Tweet";

  // COMENTADO var text = "I scored " + this.score + " points at 2048, a game where you " + "join numbers to score high! #2048game";
  // COMENTADO tweet.setAttribute("data-text", text);

  // COMENTADO return tweet;
// COMENTADO };
//variables******************************************************************
var selectedWord = "";
var selectedHint = "";
var board = [];
var remainingGuesses = 6;
var words = [   { word: "snake", hint: "It's a reptile" },
                { word: "monkey", hint: "It's a mammal" },
                { word: "beetle", hint: "It's an insect" }];
var alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 
                'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
//============================================================================

//listeners*******************************************************************
window.onload = startGame();
//============================================================================


//functions********************************************************************
function startGame()
{
    pickWord();
    initBoard();
    updateBoard();
    createLetters();
    seedButtons();
}
//****************************************************************************

function initBoard()
{
    for (var letter in selectedWord)
    {
        board.push("_");
    }
}
//******************************************************************************

function pickWord()
{
    var randomInt = Math.floor(Math.random() * words.length);
    selectedWord = words[randomInt].word.toUpperCase();
    selectedHint = words[randomInt].hint;
}
//******************************************************************************

function updateBoard()
{
    $("#word").empty();
    
    for (var letter of board)
    {
        document.getElementById("word").innerHTML += letter + " ";
    }
    
    $("#word").append("<br />");
    $("#word").append("<button class='hint'>Show Hint</button><br />");
    $("#word").append("<span id='warning'>(hint costs one guess)</span>");
    $("#word").append("<span id='hint'>Hint: " + selectedHint + "</span>");
}
//******************************************************************************

function createLetters()
{
    for (var letter of alphabet)
    {
        $("#letters").append("<button class='letter btn btn-success' id='" + letter +
                             "'>" + letter + "</button>");
    }
}
//******************************************************************************

function checkLetter(letter)
{
    var positions = new Array();
    
    for (var i = 0; i < selectedWord.length; i++)
    {
        console.log(selectedWord)
        if (letter == selectedWord[i])
        {
            positions.push(i);
        }
    }
    
    if(positions.length > 0)
    {
        updateWord(positions, letter);
        
        if(!board.includes('_'))
        {
            endGame(true);
        }
    }
    else
    {
        remainingGuesses -= 1;
        updateMan();
    }
    
    if(remainingGuesses <= 0)
    {
        endGame(false);
    }
}
//******************************************************************************

function updateWord(positions, letter)
{
    for (var pos of positions)
    {
        board[pos] = letter;
    }
    
    updateBoard();
}
//******************************************************************************

function updateMan()
{
    $("#hangImg").attr("src", "img/stick_" + (6 - remainingGuesses) + ".png");
}
//******************************************************************************

function endGame(win)
{
    $("#letters").hide();
    
    if(win){
        $("#won").show();
        $("#hist_table").append("<tr><td>" + selectedWord + "</td></tr>");
    }
    else
    {
        $("#lost").show();
    }
}
//******************************************************************************

function disableButton(btn)
{
    btn.prop("disabled", true);
    btn.attr("class", "btn-danger");
}
//******************************************************************************

function seedButtons()
{
    $(".letter").click(function(){
       checkLetter($(this).attr("id"));
       disableButton($(this));
    });

    $(".replayBtn").on("click", function(){
       reset();
    });
    
    $(".letter").click(function(){
        console.log($(this).attr("id"));
    });
    
    $(".hint").click(function() {
        $("#hint").show();
        $(".hint").hide();
        $("#warning").hide();
        remainingGuesses -= 1;
        updateMan();
    });
}
//******************************************************************************

function reset()
{
    selectedWord = "";
    selectedHint = "";
    remainingGuesses = 6;
    board = [];
    updateMan();
    $("#lost").hide();
    $("#won").hide();
    $("#letters").show();
    document.getElementById("word").innerHTML = "";
    document.getElementById("letters").innerHTML = "";
    startGame();
}

/*
$("#letterBtn").click(function(){
    var boxVal = $("#letterBox").val();
    console.log("You pressed the button and it had the value: " + boxVal);
})
*/
//==============================================================================
// script file for FlashCard App


function nextWord(words) {
    
    var x = Object.keys(words);
    var length = x.length;
    var rndNum = Math.floor( Math.random() * length  );
    var nextJWord = words[rndNum].word;
    document.getElementById("sightWord").innerHTML = nextJWord;
    document.getElementById("button2").onclick = function() { speak(nextJWord) }; 
    
}

// say a message
function speak(text, callback) {
    var u = new SpeechSynthesisUtterance();
    u.text = text;
    u.lang = 'en-US';
        
    u.onend = function () {
        if (callback) {
            callback();
        }
    };

    u.onerror = function (e) {
        if (callback) {
            callback(e);
        }
    };

    speechSynthesis.speak(u);
    }
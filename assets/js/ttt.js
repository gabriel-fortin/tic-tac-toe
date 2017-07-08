/**
 * Created by Gabriel Fortin
 */

const NEW_GAME_DELEAY = 1500;  // in ms

window.onload = function() { prepare(); };

function prepare() {
    window.gameWinner = null;
    window.boardState = new Array(9).fill('_');
    window.nextSymbol = Math.random()<0.5 ? 'x' : 'o';

    setNextPlayerSymbol(window.nextSymbol);
}

// this function is referenced in 'board.php'
function cellClick(cellImgTag, pos) {
    // no moves when game finished
    if (window.gameWinner !== null) return;
    // no moves on occupied cells
    if (window.boardState[pos] !== '_') return;

    var transcriptionTag = document.getElementById('board-transcription');

    // update internal board state
    window.boardState[pos] = window.nextSymbol;
    transcriptionTag.value = window.boardState.join('');

    // update visual board state
    cellImgTag.src = cellImgTag.src.replace('empty', window.nextSymbol);

    window.gameWinner = checkWinner(window.boardState, true);

    if (window.gameWinner !== null) {
        var button = document.getElementsByName('board-send')[0];
        setTimeout(function() { button.click() }, NEW_GAME_DELEAY);

        // show winner text using last shown symbol
        if (window.gameWinner !== '_') {
            document.getElementById('board-info').classList.add('text-right');
        } else {
            var nextPlayerTag = document
                .getElementsByClassName('play-section') [0]
                .getElementsByClassName('symbol-and-player') [0];
            nextPlayerTag.classList.add('invisible');
        }
    } else {
        window.nextSymbol = window.nextSymbol==='x' ? 'o' : 'x';
        setNextPlayerSymbol(window.nextSymbol);
    }
}

function checkWinner(brd, shouldMark) {
    var boardTable = document
        .getElementsByClassName('play-section') [0]
        .getElementsByClassName('board') [0];

    // horizontal lines' check
    for (var row=0 ; row<3 ; row++) {
        if (brd[3*row] === '_') continue;
        if (brd[3*row] === brd[3*row+1] && brd[3*row] === brd[3*row+2]) {
            for (var i=0 ; i<3 && shouldMark ; i++) {
                markWinOn(boardTable, row, i);
            }
            return brd[3*row];
        }
    }

    // vertical lines' check
    for (var col=0 ; col<3 ; col++) {
        if (brd[col] === '_') continue;
        if (brd[col] === brd[col+3] && brd[col] === brd[col+6]) {
            for (var i=0 ; i<3 && shouldMark ; i++) {
                markWinOn(boardTable, i, col);
            }
            return brd[col];
        }
    }

    // first diagonal check
    if (brd[0] !== '_' && brd[0] === brd[4] && brd[0] === brd[8]) {
        for (var i=0 ; i<9 && shouldMark ; i+=4) {
            markWinOn(boardTable, Math.floor(i/3), i % 3);
        }
        return brd[0];
    }

    // second diagonal check
    if (brd[2] !== '_' && brd[2] === brd[4] && brd[2] === brd[6]) {
        for (var i=2 ; i<7 && shouldMark ; i+=2) {
            markWinOn(boardTable, Math.floor(i/3), i % 3);
        }
        return brd[2];
    }

    // if board filled then winner is '_'
    if (brd.indexOf('_') === -1) {
        return '_';
    }

    return null;
}

function setNextPlayerSymbol(symbol) {
    var regex = /\w+\.svg/;
    var replacement = symbol + '.svg';
    var nextSymbolImgTag = document.getElementById('next-player-symbol');
    nextSymbolImgTag.src = nextSymbolImgTag.src.replace(regex, replacement);

    var playerNameTag = document.getElementById('player-name-' + symbol);
    var otherPlayerTag = document.getElementById('player-name-' + (symbol==='x'?'o':'x'));
    otherPlayerTag.classList.add('invisible');
    playerNameTag.classList.remove('invisible');

    if (isAiEnabled() && symbol === 'o') {
        computeAndPerformAiMove();
    }
}

function isAiEnabled() {
    return ! document.getElementById('ai-info').classList.contains('invisible');
}

function computeAndPerformAiMove() {
    var brd = window.boardState;

    var movesCount = 0;
    for (var i=0 ; i<9 ; i++) {
        if (brd[i] !== '_') movesCount++;
    }

    if (movesCount === 0) {
        performAiMove(0);
        return;
    }

    // play in middle if possible
    if (movesCount === 1) {
        if (brd[4] === '_') {
            performAiMove(4);
        } else {
            performAiMove(0);
        }
        return;
    }

    // again, try to take middle
    if (movesCount === 2) {
        // middle is empty => we played top-left => play middle
        if (brd[4] === '_') {
            performAiMove(4);
            return;
        }
        var choices = [1, 3, 8];
        var action = choices[Math.floor(choices.length * Math.random())];
        performAiMove(action);
        return;
    }

    // first, try to win game
    for (var i=0 ; i<9 ; i++) {
        if (brd[i]!=='_') continue;
        var hipotheticalBrd = brd.slice();  // copy array
        hipotheticalBrd[i] = 'o';
        if (checkWinner(hipotheticalBrd, false) === 'o') {
            performAiMove(i);
            return;
        }
    }

    // second, try not to lose game
    for (var i=0 ; i<9 ; i++) {
        if (brd[i]!=='_') continue;
        var hipotheticalBrd = brd.slice();  // copy array
        hipotheticalBrd[i] = 'x';
        if (checkWinner(hipotheticalBrd, false) === 'x') {
            performAiMove(i);
            return;
        }
    }

    // anything starting with top-middle
    for (var i=1 ; i<9 ; i++) {
        if (brd[i] === '_') {
            performAiMove(i);
            return;
        }
    }

    // then top-left
    performAiMove(0, 0);
}

function performAiMove(pos) {
    var boardTable = document
        .getElementsByClassName('play-section') [0]
        .getElementsByClassName('board') [0];

    var imgTag = boardTable.rows[Math.floor(pos/3)].cells[pos%3].getElementsByTagName('img')[0];
    setTimeout(function () {
        imgTag.click();
    }, 100);
}

function markWinOn(boardTable, row, col) {
    boardTable.rows[row].cells[col].classList.add('winning-cell');
}

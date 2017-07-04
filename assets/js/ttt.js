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

    var transcriptionTag = document.getElementById('board_transcription');

    // update internal board state
    window.boardState[pos] = window.nextSymbol;
    transcriptionTag.value = window.boardState.join('');

    // update visual board state
    cellImgTag.src = cellImgTag.src.replace('empty', window.nextSymbol);

    window.gameWinner = checkWinner();

    if (window.gameWinner !== null) {
        var button = document.getElementsByName('board_send')[0];
        setTimeout(function() { button.click() }, NEW_GAME_DELEAY);

        // show winner text using last shown symbol
        document.getElementById('board_info').classList.add('text-right');
    } else {
        window.nextSymbol = window.nextSymbol==='x' ? 'o' : 'x';
        setNextPlayerSymbol(window.nextSymbol);

    }
}

function checkWinner() {
    var boardTable = document
        .getElementsByClassName('play-section') [0]
        .getElementsByClassName('board') [0];

    var brd = window.boardState;

    // horizontal lines' check
    for (var row=0 ; row<3 ; row++) {
        if (brd[3*row] === '_') continue;
        if (brd[3*row] === brd[3*row+1] && brd[3*row] === brd[3*row+2]) {
            for (var i=0 ; i<3 ; i++) {
                setWinOn(boardTable, row, i);
            }
            return brd[3*row];
        }
    }

    // vertical lines' check
    for (var col=0 ; col<3 ; col++) {
        if (brd[col] === '_') continue;
        if (brd[col] === brd[col+3] && brd[col] === brd[col+6]) {
            for (var i=0 ; i<3 ; i++) {
                setWinOn(boardTable, i, col);
            }
            return brd[col];
        }
    }

    // first diagonal check
    if (brd[0] !== '_' && brd[0] === brd[4] && brd[0] === brd[8]) {
        for (var i=0 ; i<9 ; i+=4) {
            setWinOn(boardTable, Math.floor(i/3), i % 3);
        }
        return brd[0];
    }

    // second diagonal check
    if (brd[2] !== '_' && brd[2] === brd[4] && brd[2] === brd[6]) {
        for (var i=2 ; i<7 ; i+=2) {
            setWinOn(boardTable, Math.floor(i/3), i % 3);
        }
        return brd[2];
    }

    return null;
}

function setNextPlayerSymbol(symbol) {
    var regex = /\w+\.svg/;
    var replacement = symbol + '.svg';
    var nextSymbolImgTag = document.getElementById('next_player_symbol');
    nextSymbolImgTag.src = nextSymbolImgTag.src.replace(regex, replacement);
}

function setWinOn(boardTable, row, col) {
    boardTable.rows[row].cells[col].classList.add('winning_cell');
}

/**
 * Created by Gabriel Fortin
 */

/* "window" is a better way to go since it is unobstrusive and is considered more standard. */
window.onload = function() { prepare(); };

function prepare() {
    window.boardState = new Array(9).fill('_');
    window.nextSymbol = Math.random()<0.5 ? 'x' : 'o';

    set_next_player_symbol(window.nextSymbol);
    window.game_winner = null;
}

function cell_click(cell_img_tag, pos) {
    if (window.game_winner !== null) return;
    if (window.boardState[pos] !== '_') return;

    var input_tag = document.getElementById('board_state');

    // update internal board state
    window.boardState[pos] = window.nextSymbol;
    input_tag.value = window.boardState.join('');
    cell_img_tag.src = cell_img_tag.src.replace('empty', window.nextSymbol);
    window.nextSymbol = window.nextSymbol==='x' ? 'o' : 'x';

    set_next_player_symbol(window.nextSymbol);

    window.game_winner = check_winner();

    if (window.game_winner !== null) {
        var button = document.getElementsByName('board_submission')[0];
        setTimeout(function() { button.click() }, 2000);
        // TODO: show text about who won; use 'window.game_winner'
    }
}

function check_winner() {
    var board_table = document
        .getElementsByClassName('play-section') [0]
        .getElementsByClassName('board') [0];

    var brd = window.boardState;

    // horizontal lines' check
    for (var row=0 ; row<3 ; row++) {
        if (brd[3*row] === '_') continue;
        if (brd[3*row] === brd[3*row+1] && brd[3*row] === brd[3*row+2]) {
            for (var i=0 ; i<3 ; i++) {
                set_win_on(board_table, row, i);
            }
            return brd[3*row];
        }
    }

    // vertical lines' check
    for (var col=0 ; col<3 ; col++) {
        if (brd[col] === '_') continue;
        if (brd[col] === brd[col+3] && brd[col] === brd[col+6]) {
            for (var i=0 ; i<3 ; i++) {
                set_win_on(board_table, i, col);
            }
            return brd[col];
        }
    }

    // first diagonal check
    if (brd[0] !== '_' && brd[0] === brd[4] && brd[0] === brd[8]) {
        for (var i=0 ; i<9 ; i+=4) {
            set_win_on(board_table, Math.floor(i/3), i % 3);
        }
        return brd[0];
    }

    // second diagonal check
    if (brd[2] !== '_' && brd[2] === brd[4] && brd[2] === brd[6]) {
        for (var i=2 ; i<7 ; i+=2) {
            set_win_on(board_table, Math.floor(i/3), i % 3);
        }
        return brd[2];
    }

    return null;
}

function set_next_player_symbol(symbol) {
    var next_symbol_img_tag = document.getElementById('next_player_symbol');
    next_symbol_img_tag.src = next_symbol_img_tag.src.replace(/\w+\.svg/, symbol+'.svg');
}

function set_win_on(board_table, row, col) {
    board_table.rows[row].cells[col].classList.add('winning_cell');
}

/**
 * Created by Gabriel Fortin
 */

/* "window" is a better way to go since it is unobstrusive and is considered more standard. */
window.onload = function() { prepare(); };

function prepare() {
    window.boardState = new Array(9).fill('_');
    window.nextSymbol = Math.random()<0.5 ? 'x' : 'o';

    var next_symbol_img_tag = document.getElementById('next_player_symbol');
    next_symbol_img_tag.src = next_symbol_img_tag.src.replace('empty', window.nextSymbol);
    game_finished = false;
}

function cell_click(cell_img_tag, pos) {
    if (game_finished === true) return;
    if (window.boardState[pos] !== '_') return;

    var input_tag = document.getElementById('board_state');

    window.boardState[pos] = window.nextSymbol;
    input_tag.value = window.boardState.join('');
    cell_img_tag.src = cell_img_tag.src.replace('empty', window.nextSymbol);
    window.nextSymbol = window.nextSymbol==='x' ? 'o' : 'x';

    game_finished = check_board_for_game_end();

    if (game_finished === true) {
        var button = document.getElementsByName('board_submission')[0];
        alert(button);
        button.click();
    }
}

function check_board_for_game_end() {
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
            return true;
        }
    }

    // vertical lines' check
    for (var col=0 ; col<3 ; col++) {
        if (brd[col] === '_') continue;
        if (brd[col] === brd[col+3] && brd[col] === brd[col+6]) {
            for (var i=0 ; i<3 ; i++) {
                set_win_on(board_table, i, col);
            }
            return true;
        }
    }

    // first diagonal check
    if (brd[0] !== '_' && brd[0] === brd[4] && brd[0] === brd[8]) {
        for (var i=0 ; i<9 ; i+=4) {
            set_win_on(board_table, Math.floor(i/3), i % 3);
        }
        return true;
    }

    // second diagonal check
    if (brd[2] !== '_' && brd[2] === brd[4] && brd[2] === brd[6]) {
        for (var i=2 ; i<7 ; i+=2) {
            set_win_on(board_table, Math.floor(i/3), i % 3);
        }
        return true;
    }

    return false;
}

function set_win_on(board_table, row, col) {
    board_table.rows[row].cells[col].classList.add('winning_cell');
}

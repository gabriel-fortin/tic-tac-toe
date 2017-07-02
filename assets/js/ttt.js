/**
 * Created by Gabriel Fortin
 */


function cell_click(img_tag, pos) {
    input_tag = document.getElementById('board_state');

    console.log("jjfhdgd");
    console.log("click on pos: " + pos);

    if (window.boardState === undefined) {
        // alert('setting board state');
        window.boardState = ['_', '_', '_', '_', '_', '_', '_', '_', '_'];
    }

    if (window.nextSymbol === undefined) {
        // alert('setting next symbol');
        window.nextSymbol = 'x';
    }

    // var pos = parseInt(img_tag.id);
    if (window.boardState[pos] == '_') {
        window.boardState[pos] = window.nextSymbol;
        img_tag.src = img_tag.src.replace('empty', window.nextSymbol);
        window.nextSymbol = window.nextSymbol==='x' ? 'o' : 'x';
        input_tag.value = window.boardState.join('');
    }

}


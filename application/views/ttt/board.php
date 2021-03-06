
<?php
    if ( ! isset($board_state)) {
        $board_state = '_________';
    }

    $mapping = str_split($board_state);
    unset($board_state);
    for ($i=0 ; $i<9 ; $i++)
    {
        switch ($mapping[$i])
        {
            case 'x':
                $mapping[$i] = 'x';
                break;
            case 'o':
                $mapping[$i] = 'o';
                break;
            case '_':
                $mapping[$i] = 'empty';
                break;
        }
        if (isset($clickable) AND $clickable == TRUE)
        {
            $format_string = '<img src="/assets/img/%s.svg" onclick="cellClick(this, %d)" />';
        }
        else
        {
            $format_string = '<img src="/assets/img/%s.svg" />';
        }
        $mapping[$i] = sprintf($format_string, $mapping[$i], $i);
    }
    $pos = 0;
?>

<table class="board">
    <tr>
        <td class="left-edge top-edge">
            <div> <?php echo $mapping[$pos++]; ?> </div>
        </td>
        <td class="top-edge">
            <div> <?php echo $mapping[$pos++]; ?> </div>
        </td>
        <td class="right-edge top-edge">
            <div> <?php echo $mapping[$pos++]; ?> </div>
        </td>
    </tr>
    <tr>
        <td class="left-edge">
            <div> <?php echo $mapping[$pos++]; ?> </div>
        </td>
        <td>
            <div> <?php echo $mapping[$pos++]; ?> </div>
        </td>
        <td class="right-edge">
            <div> <?php echo $mapping[$pos++]; ?> </div>
        </td>
    </tr>
    <tr>
        <td class="left-edge bottom-edge">
            <div> <?php echo $mapping[$pos++]; ?> </div>
        </td>
        <td class="bottom-edge">
            <div> <?php echo $mapping[$pos++]; ?> </div>
        </td>
        <td class="right-edge bottom-edge" >
            <div> <?php echo $mapping[$pos++]; ?> </div>
        </td>
    </tr>
</table>


<?php
    if ( ! isset($board_state)) {
        // TODO: change to '_________'
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
            $format_string = '<img src="/assets/img/%s.svg" onclick="cell_click(this, %d)" />';
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
        <td>
            <div class="content left-edge top-edge">
                <?php echo $mapping[$pos++]; ?>
            </div>
        </td>
        <td>
            <div class="content top-edge">
                <?php echo $mapping[$pos++]; ?>
            </div>
        </td>
        <td>
            <div class="content right-edge top-edge">
                <?php echo $mapping[$pos++]; ?>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="content left-edge">
                <?php echo $mapping[$pos++]; ?>
            </div>
        </td>
        <td>
            <div class="content">
                <?php echo $mapping[$pos++]; ?>
            </div>
        </td>
        <td>
            <div class="content right-edge">
                <?php echo $mapping[$pos++]; ?>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="content left-edge bottom-edge">
                <?php echo $mapping[$pos++]; ?>
            </div>
        </td>
        <td>
            <div class="content bottom-edge">
                <?php echo $mapping[$pos++]; ?>
            </div>
        </td>
        <td>
            <div class="content right-edge bottom-edge">
                <?php echo $mapping[$pos++]; ?>
            </div>
        </td>
    </tr>
</table>

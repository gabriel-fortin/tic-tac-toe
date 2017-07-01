
<?php
    if ( ! isset($additional_board_classes))
    {
        $additional_board_classes = "";
    }
?>

<table class="board <?php echo $additional_board_classes ?>">
    <tr>
        <td>
            <div class="content left-edge top-edge">
                <img src="/assets/img/o.svg"/>
            </div>
        </td>
        <td>
            <div class="content top-edge">
                <img src="/assets/img/o.svg"/>
            </div>
        </td>
        <td>
            <div class="content right-edge top-edge">
                <img src="/assets/img/o.svg"/>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="content left-edge">
                <img src="/assets/img/empty.svg"/>
            </div>
        </td>
        <td>
            <div class="content">
                <img src="/assets/img/o.svg"/>
            </div>
        </td>
        <td>
            <div class="content right-edge">
                <img src="/assets/img/x.svg"/>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="content left-edge bottom-edge">
                <img src="/assets/img/o.svg"/>
            </div>
        </td>
        <td>
            <div class="content bottom-edge">
                <img src="/assets/img/x.svg"/>
            </div>
        </td>
        <td>
            <div class="content right-edge bottom-edge">
                <img src="/assets/img/o.svg"/>
            </div>
        </td>
    </tr>
</table>

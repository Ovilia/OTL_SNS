<h2>寻找公共时间</h2>
请选择好友：<br>
<?php
$UID = array();
$fedAmt = count($fedUser);
for ($i = 0; $i < $fedAmt; ++$i){
    $UID[] = $fedUser[$i]->FEEDER_ID;
    $username = User::model()->findByPk($fedUser[$i]->FEEDER_ID)->USER_NAME;
    echo '<button id="user_button' . $fedUser[$i]->FEEDER_ID .
        '" class="user button medium gray" type="button" value="0" onclick="check_user(\'' . 
        $fedUser[$i]->FEEDER_ID . '\')">' . 
        $username . '</button>';
}

$feedAmt = count($feedUser);
for ($i = 0; $i < $feedAmt; ++$i){
    if (!in_array($feedUser[$i]->FED_ID, $UID, true)){
        $UID[] = $feedUser[$i]->FED_ID;
        $username = User::model()->findByPk($feedUser[$i]->FED_ID)->USER_NAME;
        echo '<button class="user button medium gray" type="button" value="0" onclick="check_user(\'' .
            $feedUser[$i]->FED_ID . '\')">' .
            $username . '</button>';
    }
}
?>

<div id="common_time_div">
    <table id="common_table">
        <?php
            $days = 7;
            $hours = 12;
            for ($i = 0; $i < $hours; ++$i){
                echo '<tr><td class="common_td" style="width:99px">' . ($i * 2) . ':00 - ' . ($i * 2 + 2) . ':00</td>';
                for ($j = 0; $j < $days; ++$j){
                    echo '<td class="common_td">&nbsp</td>';
                }
                echo '</tr>';
            }
        ?>
    </table>
    <div id="common_time"></div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    UID = new Array();
    sendAjax();
});

function getPercent(time){
    // get hour, minute, second from time string
    var hourPos = time.indexOf(":");
    var hour = removeZero(time.substr(0, hourPos));
    time = time.substr(hourPos + 1);
    var minPos = time.indexOf(":");
    var min = removeZero(time.substr(0, minPos));
    var sec = removeZero(time.substr(minPos + 1));

    // calculate percentage
    return (hour * 3600.0 + min * 60 + sec) / (24 * 3600);
}

// add "0" to the front if is less than 10 and return string
function addZero(num){
    if (num < 10){
        return "0" + num;
    }else{
        return "" + num;
    }
}

// remove "0" in the front and return int
function removeZero(str){
    if (str == null || str == ''){
        return;
    }
    if (str[0] == '0'){
        return parseInt(str.substr(1));
    }else{
        return parseInt(str);
    }
}

function getTime(percent){
    var sec = Math.floor(percent * 3600 * 24);
    var min = Math.floor(sec / 60);
    var hour = Math.floor(min / 60);
    min = min - hour * 60;
    sec = sec - hour * 3600 - min * 60;
    return hour + ":" + addZero(min) + ":" + addZero(sec);
}

function drawClass(dayOfWeek, start_percentOfDay, length_percentOfDay){
    var startStr = getTime(start_percentOfDay);
    var endStr = getTime(start_percentOfDay + length_percentOfDay);
    $("#common_time").append('<div class="time_block transparent_class" id="class_' + class_id + '"' + 'title="开始时间：' + startStr + '\n结束时间：' + endStr + '"' + '></div>');
    var width = parseInt($("#class_" + class_id).css("width"));
    var height = parseInt($("#class_" + class_id).css("height"));
    var old_left = parseInt($("#class_" + class_id).css("left"));
    /* Move up to eliminate effects caused by class drawn before.
     * I do understand it's not a good idea to add strage comments like this one,
     * but I still want to say..
     * What magic code it is..
     */
    var old_top = parseInt($("#class_" + class_id).css("top")) - classLength; 
    $("#class_" + class_id).css("top", old_top - 460 * (11.0 / 12 - start_percentOfDay));
    $("#class_" + class_id).css("height", height * 12 * length_percentOfDay);
    // Move right
    $("#class_" + class_id).css("left", old_left + width * dayOfWeek);
    class_id++;
    classLength += height * 12 * length_percentOfDay;
}

function check_user(id){
    // Toggle green and gray style of button
    $("#user_button" + id).toggleClass("green");
    $("#user_button" + id).toggleClass("gray");
    if ($("#user_button" + id).val() == 0){
        $("#user_button" + id).val(1);
    }else{
        $("#user_button" + id).val(0);
    }

    // Calculate clicked users
    UID = new Array();
    $(".user").each(function(){
        if ($(this).val() == 1){
            // 11 is the length of user_number
            UID.push($(this).attr('id').substr(11));
        }
    });

    sendAjax();
}

function sendAjax(){
    // Get common time from db
    $.ajax({
        type:"POST",
        url:"<?php echo CHtml::normalizeUrl(array('user/getCommon')); ?>",
        data:"ajax='ajax'&uid=" + UID,
        dataType:"json",
        success: function(result){
            $("#common_time").html('');
            class_id = 0;
            classLength = 0;
            var clickedAmt = result.common[0].length;
            for (var i = 0; i < clickedAmt; ++i){
                var classAmt = result.common[0][i].length;
                for (var j = 0; j < classAmt; ++j){
                    var start = getPercent(result.common[0][i][j]['START_TIME']);
                    var length = getPercent(result.common[0][i][j]['END_TIME']) - start;
                    drawClass(result.common[0][i][j]['DAY_OF_WEEK'],
                        start, length);
                }
            }
        }
    });
}
</script>



<div class="view">
    <table>
        <tr>
            <td>
                课程代号
            </td>
            <td>
                <?php echo CHtml::link(CHtml::encode($data->COURSE_CODE), array('class/view', 'id' => $data->CID)); ?>
            </td>
        </tr>
        <tr>
            <td>
                学年
            </td>
            <td>
                <?php echo CHtml::encode($data->YEAR); ?>
            </td>
        </tr>
        <tr>
            <td>
                学期
            </td>
            <td>
                <?php echo CHtml::encode($data->SEMESTER); ?>
            </td>
        </tr>
    </table>    
</div>

<?php
session_start();

ob_start();
if ($_SESSION['user_email'] == "") {
    header("Location: ../login.php");
}
include("../php/db_connect.php");
include("../php/db_querys.php");

$id = getUserId($connection);
createTaskArr($connection, $id);
$select_date = [date('Y'), (date('m'))];



?>
let currentMonth =
<?php echo ($select_date[1] - 1); ?>;
let currentYear =
<?php echo $select_date[0]; ?>;
let years = [];
$("#inputYear > option").map(function(){
years.push($(this).val());
});


function clearSelected(){
$(this).removeAttr("selected");
}

function setMonth(month){
let inputMonth = $( "#inputMonth > option" );
inputMonth.each(clearSelected);

inputMonth.each(function(i) {
if(i == month){
$(this).attr("selected", "selected");
}
});
}

setMonth(currentMonth);

function setYear(year){
let inputYear = $( "#inputYear > option" );
inputYear.each(clearSelected);
inputYear.each(function() {
if($(this).val() == year){
$(this).attr("selected", "selected");
}
});
}

setYear(currentYear);


$(".next").on("click", function(e){
e.stopPropagation();
currentMonth++;
if(currentMonth > 11){
let maxYear = Math.max(...years);
currentMonth = 0;
if(currentYear+1 <= maxYear){ currentYear +=1; } setYear(currentYear); } setMonth(currentMonth);
    monthFillDays(currentYear, currentMonth); getCountOfTasks(); }); $(".prev").on("click", function(e){
    e.stopPropagation(); let minYear=Math.min(...years); currentMonth--; if(currentMonth < 0){ currentMonth=11;
    if(currentYear-1>= minYear){
    currentYear -= 1;
    }
    setYear(currentYear);
    }
    setMonth(currentMonth);
    monthFillDays(currentYear, currentMonth);
    getCountOfTasks();
    });

    $("#inputMonth").on("change", function(e){
    e.stopPropagation();
    currentMonth = +$(this).val();
    setMonth(currentMonth);
    monthFillDays(currentYear, currentMonth);
    getCountOfTasks();
    });

    $("#inputYear").on("change", function(e){
    currentYear = +$(this).val();
    setYear(currentYear);
    monthFillDays(currentYear, currentMonth);
    getCountOfTasks();
    });

    function daysInMonth(iYear, iMonth) {
    return 32 - new Date(iYear, iMonth, 32).getDate();
    }

    function monthFillDays(iYear, iMonth){
    $("#monthDays").html('');
    let days = daysInMonth(iYear, iMonth);
    if(iMonth < "10" ){ iMonth="0" +(iMonth+1); }else{ iMonth++; } for (let i=1; i <=days; i++) { let day=0; if(i < 10){
        day="0" +i; }else{ day=i; } $("#monthDays").append('<div class="col col-md"
        name="' + iYear + '-'+ iMonth +'-'+ day +'">' +
        '<div class="date-day">'+ i +'</div>' +
        '</div>');
        }
        }

        monthFillDays(currentYear, currentMonth);


        function getCountOfTasks(){
        $("#monthDays > .col").map(function(){
        let date = $(this).attr("name");
        let index = 0;
        for (let i = 0; i < db_array.length; i++) { if(db_array[i]==date){ index++; } } if( index> 0){
            $(this).append('<div class="number-of-tasks">'+ index +'</div>');
            }else{
            $(this).append('<div class="number-of-tasks">0</div>');
            }
            });
            }

            $("#all-user-tasks").text((db_array.length/4)); // set number of tasks

            function showTask(){
            let date = $(this).attr("name");
            let index, tasknum = 1;
            $("#viewTaskModal .modal-body ").html("");
            for (let i = 0; i < db_array.length; i++) { if(db_array[i]==date){ index=i+1; $("#viewTaskModal
                .modal-body").append('<div class="task mb-4">'+
                '<p><strong>'+ tasknum +'.</strong> ' + db_array[index] + '</p>'+
                '<a href="../php/taskmanager.php?taskId='+ db_array[index-3] +'"
                    class="btn btn-outline-danger d-flex align-items-center" name="taskDeleteBtn">'+
                    '<i class="fas fa-times"></i>'+
                    '</a>'+
                '</div>');
                tasknum++;
                }
                }
                $(".taskDate").attr("value", "");
                $(".taskDate").attr("value", date);
                let taskContext = db_array[index];
                if(taskContext == undefined){
                $("#viewTaskModal .modal-body").html("<p>Today You don't have any tasks! Just Chillout!</p>");
                }
                $('#viewTaskModal').modal('show');
                }

                $(".task input").on("mousedown .task", function(){
                $(this).attr("name", "40");
                });
                $("#monthDays > .col").on("click ", showTask);

                $("#monthDays").on("mouseenter", function(){
                $("#monthDays > .col").unbind("click").on("click ", showTask);
                });

                getCountOfTasks();


                function resetimg() {
                setTimeout( function(){
                $("#customFile").val("");

                }, 500);
                setTimeout( function(){
                $("#img_info").css("display", "none");

                }, 10000);

                }

                $("#btnImage").on("click", resetimg());
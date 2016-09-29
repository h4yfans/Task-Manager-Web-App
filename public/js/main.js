/**
 * Created by Kaan on 9/28/2016.
 */
var taskID = 0;
var postBodyElement = null;

$('.task').find('.change').find('.edit').on('click', function (event) {
    event.preventDefault();
    postBodyElement = event.target.parentNode.parentNode.childNodes[1];
    var taskBody = postBodyElement.textContent;
    taskID = event.target.parentNode.parentNode.dataset['taskid'];
    console.log(taskBody);
    console.log(taskID);

    $('#task-body').text(taskBody);
    $('#modal1').openModal();

});

$('#modal-save').on('click', function () {
    $.ajax({
        method: 'POST',
        url: urlEdit,
        data: {
            task_name: $('#task-body').val(),
            taskId: taskID,
            _token: token
        }
    }).done(function (msg) {
        console.log(msg);
        $(postBodyElement).text(msg['new_body']);
        $('#modal1').closeModal();

    });
});


$(document).ready(function () {



        const token = $('meta[name="csrf-token"]').attr("content");

        function ajax(
            url,
            method,
            data,
            success,
            error,
            dataType = "json",
            contentType = "application/x-www-form-urlencoded; charset=UTF-8",
            processData = true
        ) {
            $.ajax({
                url: url,
                method: method,
                data: data,
                dataType: dataType,
                success: success,
                error: error,
                contentType: contentType,
                processData: processData,
            });
        }

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr("content"),
            },
        });
  $('#regdate').click(dateSort)
    $('#logdate').click(dateFilterLog)
    $('#logoutdate').click(dateFilterLogout)


function dateSort(){
  var date= $('#date').val()
    // alert(date)
    ajax(
        `/filterRegister`,
        "GET",
        {date: date},
        function (data) {
            // console.log(data)
            showRegister(data);
        },
        function (xhr, status, statusText) {
            console.error(xhr.responseText);
        },
        "json"
    );
}
    function dateFilterLog(){
        var date= $('#datelog').val()
        // alert(date)
        ajax(
            `/filterLogins`,
            "GET",
            {date: date},
            function (data) {
                // console.log(data)
                showLogins(data);
            },
            function (xhr, status, statusText) {
                console.error(xhr.responseText);
            },
            "json"
        );
    }

function dateFilterLogout(){
    var date= $('#datelogout').val()
    // alert(date)
    ajax(
        `/filterLogouts`,
        "GET",
        {date: date},
        function (data) {
            // console.log(data)
            showLogouts(data);
        },
        function (xhr, status, statusText) {
            console.error(xhr.responseText);
        },
        "json"
    );
}

})
function showRegister(data){
   var ispis=``
    if(data.length!=0) {



        for (d of data) {
            var date=new Date(d.created_at)
            var dateFinal=date.toLocaleString('en-GB')
            console.log(date)
            ispis += `<li>
                                                <img src="assets/images/${d.img}" alt="User Image">
                                                <a class="users-list-name" href="#">${d.name}</a>
                                                <span class="users-list-date">${dateFinal}</span>
                                            </li>`
        }

    }
    else{
        ispis=`<h4>No one has been registred on this day</h4>`
    }
    $('#userstable').html(ispis)
}
function showLogins(data){
    var ispis=``
    if(data.length!=0) {



        for (d of data) {
            var date=new Date(d.created_at)
            var dateFinal=date.toLocaleString('en-GB')
            ispis += `<tr>
                                            <td><p>${d.ip}</p></td>
                                            <td><p>${d.url}</p></td>
                                            <td><p>${d.method}</p></td>
                                            <td><p>${d.email}</p></td>
                                            <td><p>${dateFinal}</p></td>
                                        </tr>`
        }

    }
    else{
        ispis=`<h4>No one has been logged on this day</h4>`
    }
    $('#tablelogins').html(ispis)
}
function showLogouts(data){
    var ispis=``
    if(data.length!=0) {



        for (d of data) {
            var date=new Date(d.created_at)
            var dateFinal=date.toLocaleString('en-GB')

            ispis += `<tr>
                                            <td><p>${d.ip}</p></td>
                                            <td><p>${d.url}</p></td>
                                            <td><p>${d.method}</p></td>
                                            <td><p>${d.email}</p></td>
                                            <td><p>${dateFinal}</p></td>
                                        </tr>`
        }

    }
    else{
        ispis=`<h4>No one has been logged out on this day</h4>`
    }
    $('#tablelogouts').html(ispis)
}

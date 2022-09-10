$(document).ready(function () {
    const token = $('meta[name="csrf-token"]').attr("content");
    console.log(window.location.pathname)
    if(window.location.pathname==="/adminUser"){
        $('.role').on('click', changeRole)

        var roles=document.getElementsByClassName('role')
        for(var i=0;i<roles.length; i++){
            roles[i].addEventListener('click', changeRole)
        }
    }
    if(window.location.pathname==="/allmovies") {
        // document.getElementById("search").addEventListener("keyup", searchMovies);
        document.getElementById("search").addEventListener("keyup", getForPagination);
        $('#filter').change(getForPagination)
        $('#sort').change(getForPagination)
    }
    if(window.location.pathname.includes("/movie-page")) {

        document.getElementById("tagButton").addEventListener("click", addTag);
        document.getElementById("add_rating").addEventListener("click", addRating);
        document
            .getElementById("delete_rating")
            .addEventListener("click", deleteRating);
        document.getElementById("user_rating").addEventListener("click", showRatingBox);
    }
    $('.carousel').carousel({
        interval: 2
    })

    $('.modal').click(showRatingBox)


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
    var id = $("#idmovie").val();
    $(".js-example-basic-multiple").select2({
        placeholder: "Select an tag",
        tags: true,
        ajax: {
            url: "/tagSearch/" + id,
            dataType: "json",
            type: "GET",
            delay: 250,
            data: function (params) {
                return {
                    term: params.term,
                    type: "public",
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.tag,
                            id: item.tag,
                        };
                    }),
                };
            },
            cache: true,
        },
    });
    var getUrl = window.location

    function getForPagination(pag){
        if($.isNumeric(pag)){
            pag=pag
        }
        else{
            pag=1
        }
        var moviesSearch = $("#search").val();
        var filterMovies=$('#filter').val();
        var sortMovies=$('#sort').val();
        getMovies(pag,moviesSearch, filterMovies, sortMovies)
    }

    function getMovies(pag,moviesSearch, filterMovies, sortMovies) {
        ajax(
            `/searchMovie/pag`,
            "GET",
            {page:pag,moviesSearch: moviesSearch, filterMovies:filterMovies, sortMovies:sortMovies},
            function (data) {
                console.log(data)
                showMovies(data);
            },
            function (xhr, status, statusText) {
                console.error(xhr.responseText);
            },
            "json"
        );
    }
    function changeRole(e) {
        e.preventDefault()
        var iduser =this.name
        var idrole = $("#role"+iduser).val();
        ajax(
            `/changeRole`,
            "GET",
            {iduser: iduser, idrole:idrole, _token: token},
            function (data) {
                console.log(data)
                roleChange(data);
            },
            function (xhr, status, statusText) {
                console.error(xhr.responseText);
            },
            "json"
        );
    }
    function roleChange(data) {
        console.log(data.roles)
        var dataUser = data.users
        var dataRoles = data.roles
        ispis = `<td>${dataUser.id}</td>
                                        <td><img src="assets/images/${dataUser.img}" width=100px></td>
                                        <td>${dataUser.email}</td>
                                        <td>${dataUser.name}</td>
                                        <td> Current role: <b>`
        if(dataUser.role!=null){ispis+=`${dataUser.role.role}`} else{ispis+=`This user has no role`}
                                      ispis+=`</b><p>Change role:</p>
                                            <input type="hidden" name="iduser" id="iduser" value="${data.id}">
                                            <select name="role${dataUser.id}" id="role${dataUser.id}">`
        for (role of dataRoles) {
            ispis += `<option value="${role.id}">${role.role}</option>`}
            ispis += `</select>
                                            <input type="submit" name="${dataUser.id}" class="role">Change</input>
                                        </td>
                                        <td><button cllas="btn-btn"><a href="/deleteUser/${dataUser.id}">Delete</a></button></td>`

        $('#row'+dataUser.id).html(ispis)
        $('.role').on('click', changeRole)
    }


    function showMovies(data) {
        var ispis = ""
        var baseUrl= window.location.origin

        var lastPage = data.last_page
        var dataSearch = data.data
        for (d of dataSearch) {
            d.ratings_avg_rating= Math.round(d.ratings_avg_rating * 10) / 10
            ispis += `  <div class="card mt-3 col-md-3" style="width: 18rem; background-color:black; border: 1px solid gray; box-shadow:5px 5px 20px 5px rgba(245, 230, 83, 0.3);">
                    <img src="${baseUrl}/assets/images/${d.img}" class="card-img-top" alt="..." style="max-height: 300px;">
                    <div class="card-body">
                        <a style='text-decoration: none' href= '/movie-page/${d.id}'><h5
                                class="movielink card-title">${d.title}</h5>
                        </a>
                        <p class="card-text">${d.year}</p>

                        <h6> Average rating:${d.ratings_avg_rating}</h6>
                    </div>
                </div>`
        }
        $("#movies").html(ispis)
        var ispis2 = ""

        for (var i = 1; i <= lastPage; i++) {
            ispis2 += `<li class="page-item"><a id="${i}" class="page-link" href="/allmovies/page=${i}">${i}</a></liclass>`
        }

        $("#paginacija").html(ispis2)
        $('.page-link').click(pagination)

    }
    function pagination(e){
        e.preventDefault()
        let id=this.id
        getForPagination(id)
    }
    function addTag() {
        var tags = $("#tagsearch").val();
        var idmovie = $("#idmovie").val();
        ajax(
            `/addTags`,
            "POST",
            {tags: tags, idmovie: idmovie, _token: token},
            function (data) {
                popUp(data);
                clearBox();
                removeOptions(document.getElementById("tagsearch"));
                console.log(data)
            },
            function (xhr, status, statusText) {
                // console.error(xhr.responseText);

            },
            "json"
        );
    }

    // Ratings

    function showRatingBox() {
        document.getElementById("modalRating").style.display = "block";
        document.getElementById("modalRating").style.position = "fixed";
        $("#closeModal").on("click", closeBox);
    }

    function closeBox() {
        document.getElementById("modalRating").style.display = "none";
        $("#errors").html("")


    }
    function addRating() {
        var idmovie = $("#idmovie").val();
        var rating = $('input[name="rating"]:checked').val();

        ajax(
            `/add-rating`,
            "POST",
            {rating: rating, idmovie: idmovie, _token: token},
            function (data) {
                console.log(data)
                $("#message_div").html(data.message);
                var wholeNumber = Math.floor(data.rating);
                var decimal = data.rating - wholeNumber;
                var print = `<p>Your rating: ${data.rating}</p> <input type="hidden" id="rating" value="${data.rating}"> </br> <h6>Click to change rating</h6>`;
                for (let i = 0; i < wholeNumber; i++) {
                    print += ` <i class="fa fa-star user_rating" aria-hidden="true" id="modal" class="btn modal" data-bs-toggle="modal" data-bs-target="#rating_modal"></i> `;
                }
                if (decimal > 0) {
                    print += `   <i class="fa fa-star-half-o user_rating" aria-hidden="true"  class="btn modal" data-bs-toggle="modal" data-bs-target="#rating_modal"></i> `;
                }

                print += `<input type="hidden" id="user_rating" value="${data.id}">`
                $("#user_rating").html(print);
                $("#errors").html(data.message);
            },
            function (xhr) {
                // $('#validation-errors').html('');
                $.each(xhr.responseJSON.errors, function (key, value) {
                    $("#errors").html(value).append(print);
                });
            },
            "json"
        );
    }

    // dodaj div na zvezdice
    function deleteRating() {
        var idrating = $("#rating").val()
        ajax(
            `/delete-rating/` + idrating,
            "POST",
            {idrating: idrating, _token: token},
            function (data) {
                $("#message_div").html(data);
                var print = `<p class="mt-3">Add your rating:</p> <i class="fa fa-star empty_star" aria-hidden="true" class="btn" data-bs-toggle="modal" data-bs-target="#rating_modal"></i> `;
                $("#errors").html(data.message);
                $("#user_rating").html(print);

            },
            function (xhr, status, statusText) {
                console.error(xhr.responseText);
            },
            "json"
        );
    }
});

function popUp(data) {
    var print = `<h1 id="popuptext">${data}</h1>
<button class="click"type="button"  id="closePopUp">Close</button>`;
    console.log(document.getElementById("popup"));

    $("#popup").html(print);
    document.getElementById("popup").style.display = "block";
    $("#popup").on("click", close);
}

function close() {
    document.getElementById("popup").style.display = "none";
}

function clearBox() {
    var print = ` `;
    $("#select2-tagsearch-container").html(print);
}

function removeOptions(selectElement) {
    var i, L = selectElement.options.length - 1;
    for (i = L; i >= 0; i--) {
        selectElement.remove(i);
    }
}


function tagsColor(e) {
    e.preventDefault();
    document.getElementById("showtags").style.color = "black";
    document.getElementById("showtags").style.backgroundColor =
        "rgba(245, 230, 83, 0.7)";
}

function tagsColorBack() {
    document.getElementById("showtags").style.color = "rgba(245, 230, 83, 0.7)";
    document.getElementById("showtags").style.backgroundColor = "black";
}

function tagsColorBack() {
    document.getElementById("showtags").style.color = "rgba(245, 230, 83, 0.7)";
    document.getElementById("showtags").style.backgroundColor = "black";
}

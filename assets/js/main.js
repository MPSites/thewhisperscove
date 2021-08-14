$(document).ready(function(){

    $("body").on("click", ".post-pag", function(){

        event.preventDefault();
        let limit = $(this).data("limit");

        $.ajax({
            url: "models/posts/post-pagination.php",
            method: "GET",
            data: {
                limit: limit
            },
            success: function(data){
                //console.log(data);

                print_posts(data.posts);
                print_pagination(data.num_of_pages);
            },
            error: function(error){
                console.log(error);
            }
        })
        
    });

    $('.order_posts').click(order_posts);
    $('.sort_posts').click(order_posts);

   

    $('.acc-opt').on('click',display_acc_content);

});

// --- admin panel --- //
 
function display_acc_content(){
    event.preventDefault();
    let data = $(this).data('use');
    //console.log(data);
    if(data === "users"){
        let user_id = $(this).data('user_id');
        //console.log(user_id);
        $.ajax({
            url: "models/users/get-users.php",
            method: "GET",
            dataType: 'json',
            success: function(users){
                //console.log(posts);
                print_acc_users(users);
                
    
            },
            error: function(error){
                console.log(error);
            }
        }) 
    } else if(data === "add"){
        $.ajax({
            url: "models/users/get-roles.php",
            method: "GET",
            dataType: 'json',
            success: function(roles){
                //console.log(roles);
                print_acc_add(roles);
                
    
            },
            error: function(error){
                console.log(error);
            }
        })
    } else if(data === "mpost"){
        let user_id = $(this).data('user_id');
        //console.log(user_id);
        $.ajax({
            url: "models/posts/get-user-posts.php",
            method: "POST",
            data: {
                user_id: user_id
            },
            dataType: 'json',
            success: function(posts){
                //console.log(posts);
                print_acc_mpost(posts);
                
    
            },
            error: function(error){
                console.log(error);
            }
        })  
    } else if(data === "npost"){
        let user_id = $(this).data('user_id');
        //console.log(user_id);
        $.ajax({
            url: "models/categories/get-categories-opt.php",
            method: "GET",
            dataType: 'json',
            success: function(cats){
                //console.log(cats);
                print_acc_npost(cats,user_id);
                
    
            },
            error: function(error){
                console.log(error);
            }
        }) 

    }else if(data === "top"){
        $.ajax({
            url: "models/categories/get-categories-opt.php",
            method: "GET",
            dataType: 'json',
            success: function(cats){
                //console.log(cats);
                print_admin_cats(cats);
                
    
            },
            error: function(error){
                console.log(error);
            }
        }) 
    } else if(data === "ntop"){
        print_category_add();
    };
}

function validate_contact(){
    let title = $('#contact_title').val();
    let message = $('#contact_body').val();
    let email = $('#contact_email').val();

    if((title == "") || (message == "") || (email == "")){
        alert("Please fill out the contact form!");
    } else {

        $.ajax({
            url: "models/functions/contact_validation.php",
            method: "POST",
            data: {
                conName: title,
                message: message,
                conEmail: email
            },
            dataType: 'json',
            success: function(msg){
                console.log(msg);
                display_alert(msg);

            },
            error: function(error){
                console.log(error);
            }
        })
    }
}

// --- CRUD User --- //

function add_user(){
    let username = $('#user_username').val();
    let password = $('#user_password').val();
    let confirm_password = $('#user_confirm_password').val();
    let first_name = $('#user_first_name').val();
    let last_name = $('#user_last_name').val();
    let email = $('#user_email').val();
    let role = $('#user_role').val();

    if((username == "") || (password == "") || (email == "") || (role == "")){
        alert("Fields with * are required!");
    } else if(password.lenght < 6){
        alert("Your password must be atleast 6 characters!");
    } else if( password != confirm_password){
        alert("Password's must match!");
    } else {

        $.ajax({
            url: "models/users/add-user.php",
            method: "POST",
            data: {
                username: username,
                password: password,
                confirm_password: confirm_password,
                first_name: first_name,
                last_name: last_name,
                email: email,
                role: role
            },
            dataType: 'json',
            success: function(msg){
                console.log(msg);
                //print_acc_users(users);
                display_alert(msg);

            },
            error: function(error){
                console.log(error);
            }
        })
    }

}

function update_user(user_id){

    let username = $('#update_username').val();
    let password = $('#update_password').val();
    let confirm_password = $('#update_confirm_password').val();
    let first_name = $('#update_first_name').val();
    let last_name = $('#update_last_name').val();
    let email = $('#update_email').val();
    let role = $('#update_role').val();
    let active = $('#update_active').val();

    if((username == "") || (password == "") || (email == "") || (role == "")){
        alert("Please fill the form with new values.");
    } else if(password.lenght < 6){
        alert("Your password must be atleast 6 characters!");
    } else if( password != confirm_password){
        alert("Password's must match!");
    } else {

        $.ajax({
            url: "models/users/update-user.php",
            method: "POST",
            data: {
                user_id: user_id,
                username: username,
                password: password,
                confirm_password: confirm_password,
                first_name: first_name,
                last_name: last_name,
                email: email,
                role: role,
                active: active
            },
            dataType: 'json',
            success: function(msg){
                console.log(msg);
                //print_acc_users(users);
                display_alert(msg);

            },
            error: function(error){
                console.log(error);
            }
        })
    }
}

function delete_user(user_id){
    //console.log(post_id);
    let user = user_id;
    $.ajax({
        url: "models/users/delete-user.php",
        method: "POST",
        data: {
            user_id: user
        },
        dataType: 'json',
        success: function(users){
            //console.log(posts);
            print_acc_users(users);
            

        },
        error: function(error){
            console.log(error);
        }
    })
}

function data_update_user(user_id){
    //console.log(user_id);
    let user = user_id;
    $.ajax({
        url: "models/users/get-user.php",
        method: "POST",
        data: {
            user_id: user
        },
        dataType: 'json',
        success: function(data){
            print_acc_upt(data.roles, user);
            user_edit_fill(data.user)
           //console.log(data.roles);
           //console.log(data.user_data);

        },
        error: function(error){
            console.log(error);
        }
    })
}

// --- CRUD Post --- //

function add_post(user_id){
    let user = user_id;
   // console.log(user_id);
    let title = $('#title').val();
    let content = $('#content').val();
    let cat_id = $('#post_cat').val();
   // console.log(title);
   // console.log(content);
    //console.log(cat_id);
    $.ajax({
        url: "models/posts/add-post.php",
        method: "POST",
        data: {
            user_id: user,
            category_id: cat_id,
            title: title,
            content: content
        },
        dataType: 'json',
        success: function(obj){
            console.log(obj);
            display_alert(obj);
            

        },
        error: function(error){
            console.log(error);
        }
    })
}

function data_update_post(post_id){
    //console.log(user_id);
    let post = post_id;
    $.ajax({
        url: "models/posts/get-post.php",
        method: "POST",
        data: {
            post_id: post
        },
        dataType: 'json',
        success: function(data){
            //console.log(data.post);
            print_acc_upd_post(data.cats,post);
            post_edit_fill(data.post);
           

        },
        error: function(xhr){
            console.log(xhr);
        }
    })
}

function update_post(post_id){

    let id = post_id;
    let title = $('#upt_title').val();
    let content = $('#upt_content').val();
    let category = $('#upt_post_cat').val();
    

    if((title == "") || (content == "") || (category == "")){
        alert("Please fill the form with new values.");
    } else {

        $.ajax({
            url: "models/posts/update-post.php",
            method: "POST",
            data: {
                post_id: id,
                title: title,
                content: content,
                category: category,
            },
            dataType: 'json',
            success: function(msg){
                console.log(msg);
                //print_acc_users(users);
                display_alert(msg);

            },
            error: function(error){
                console.log(error);
            }
        })
    }
}

function delete_post(post_id,user_id){
    //console.log(post_id);
    let post = post_id;
    let user = user_id;
    $.ajax({
        url: "models/posts/delete-post.php",
        method: "POST",
        data: {
            post_id: post,
            user_id: user
        },
        dataType: 'json',
        success: function(posts){
            //console.log(posts);
            print_acc_mpost(posts);
            

        },
        error: function(error){
            console.log(error);
        }
    })
}

// CRUD categories //

function add_category(){
    let name = $('#title').val();
    $.ajax({
        url: "models/categories/add-category.php",
        method: "POST",
        data: {
            category_name : name
        },
        dataType: 'json',
        success: function(obj){
            console.log(obj);
            display_alert(obj);
            

        },
        error: function(error){
            console.log(error);
        }
    })
}

function delete_category(category_id){
    //console.log(post_id);
    let id = category_id;
    $.ajax({
        url: "models/categories/delete-category.php",
        method: "POST",
        data: {
            id: id,
        },
        dataType: 'json',
        success: function(data){
            //console.log(posts);
            print_admin_cats(data);
            

        },
        error: function(error){
            console.log(error);
        }
    })
}

// ** ORDER and SORT ** //

function order_posts(){
    event.preventDefault()
    let sort = $(this).data('order');
    //console.log(sort);

    $('#pag-list').addClass('hidden');

    $.ajax({
        url: "models/posts/sort-posts.php",
        method: "POST",
        data: {
            sort: sort
        },
        dataType: 'json',
        success: function(data){
            //console.log(data);
            //console.log(data.posts);
            print_posts(data);

        },
        error: function(error){
            console.log(error);
        }
    })
}

$("body").on("click", ".reset", function(){

    event.preventDefault();

    $('#pag-list').removeClass('hidden');

    $.ajax({
        url: "models/posts/post-pagination.php",
        method: "GET",
        data: {
            limit: 0
        },
        success: function(data){
            //console.log(data);

            print_posts(data.posts);
            print_pagination(data.num_of_pages);
        },
        error: function(error){
            console.log(error);
        }
    })
    
});

function display_alert(obj){
    alert(obj.msg);
}

// --- print content --- //

function print_posts(posts){
    let html = "";
    for(let post of posts){
        let date = new Date(post.post_date);
        date = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
        html += `
        <div class="post-row">
				<div class="blog-post">
					
					<div class="blog-post-inner">
						<a href="#" class="post-about">	
							<div class="post-member">
								<img src="assets/img/user_images/${post.avatar_img}" alt="avatar-image">
								<span class="post-user">${post.username}</span>
								<span class="acc-role">${post.role_name}</span>
							</div>
						</a>
						<div class="post-content">
							<h2 class="blog-post-title">${post.title}</h2>
                            <p>${post.content}</p>
                            <p><a href="index.php?page=post&post_id=${post.post_id}" class="">Continue reading...</a></p>
						</div>
					</div>
					<div class="post-date">
						<i class="fa fa-clock-o" aria-hidden="true"></i>
						${date}
						
					</div>
				</div>
			</div> `;
    }
    $('#main-post-area').html(html);
} 

function print_acc_add(roles){
    let html = `<div class="form-container acc-form">
    <div class="form-inner">
        <ul class="edit-form">
            <li><h2>Add user</h2></li>
            <li><form action="" method="POST" id="user-form"></li>
            <li><label>Username * :</label></li>
            <li><input id="user_username" name="user_username" type="text" required></li> 
            <li><label>Password * :</label></li>
            <li><input id="user_password" name="user_password" type="password" required></li> 
            <li><label>Confirm password * :</label></li>
            <li><input id="user_confirm_password" name="user_confirm_password" type="password" required></li> 
            <li><label>First name:</label></li>
            <li><input id="user_first_name" name="user_first_name" type="text" ></li> 
            <li><label>Last name:</label></li>
            <li><input id="user_last_name" name="user_last_name" type="text" ></li> 
            <li><label>Email * :</label></li>
            <li><input id="user_email" name="email" type="email" required></li> 
            <li><label>Role * :</label></li>
            <li><select id="user_role" name="user_role">
                <option value="0">Choose</option>`;
    for(role of roles){
        html += `<option value="${role.role_id}">${role.role_name}</option>`;
    }
    html += `</select></li>
            <li>
                <button id="user_submit" type="submit" class="btn-reg" onclick=add_user()>Add user</button>
                </form>
            </li>
        </ul>
    </div>
</div>`;
$('#acc-content').html(html);
}

function print_acc_upt(roles,user){
    let html = `<div class="form-container acc-form">
    <div class="form-inner">
        <ul class="edit-form">
            <li><h2>Edit user info</h2></li>
            <li><form action="" method="POST" id="user-form"></li>
            <li><label>Username:</label></li>
            <li><input id="update_username" name="user_username" type="text" required></li> 
            <li><label>Password:</label></li>
            <li><input id="update_password" name="user_password" type="password" required></li> 
            <li><label>Confirm password:</label></li>
            <li><input id="update_confirm_password" name="user_confirm_password" type="password" required></li> 
            <li><label>First name:</label></li>
            <li><input id="update_first_name" name="user_first_name" type="text" ></li> 
            <li><label>Last name:</label></li>
            <li><input id="update_last_name" name="user_last_name" type="text" ></li> 
            <li><label>Email:</label></li>
            <li><input id="update_email" name="email" type="email" required></li> 
            <li><label>Role:</label></li>
            <li><select id="update_role" name="user_role">
                <option value="0">Choose</option>`;
    for(role of roles){
        html += `<option value="${role.role_id}">${role.role_name}</option>`;
    }
    html += `</select></li>
            <li><label for="active">Activity:</label></li>
            <li>
                <select id="update_active" name="active" class="form-control">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
                </select>
            </li>
            <li>
                <button id="user_submit" type="submit" class="btn-login" onclick=update_user(${user})>Change</button>
                </form>
            </li>
        </ul>
    </div>
</div>`;
$('#acc-content').html(html);
}

function user_edit_fill(user_data){
    //console.log(user_data);
    for(data of user_data){
        $('#update_username').val(data.username);
        $('#update_first_name').val(data.first_name);
        $('#update_last_name').val(data.last_name);
        $('#update_email').val(data.email);
        $('#update_role').val(data.role_id);
    }
}

function print_acc_users(users){
    let rb = 1;
    let html = `<div class="my-posts">
                    <table class="table-user user-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>`;
    for(user of users){
        html+= `<tr>
                    <td>${rb}</td>
                    <td>${user.username}</td>
                    <td>${user.first_name} ${user.last_name}</td>
                    <td>${user.email}</td>
                    <td>${user.role_name}</td>
                    <td>
                        <button type="submit" class="btn delete" onclick="delete_user(${user.user_id})" ><i class="fa fa-trash" aria-hidden="true"></i></button>
                        <button type="submit" class="btn edit" onclick="data_update_user(${user.user_id})" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                        </button>
                    </td>
                </tr>`;
    rb++;
    }
    html += `</tbody>
    </table>
</div>`;
    $('#acc-content').html(html);
}


function print_acc_mpost(posts){
    let rb = 1;
    let html = `<div class="my-posts">
                    <table class="table-user user-posts">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>`;
    for(post of posts){
        html+= `<tr>
                    <td>${rb}</td>
                    <td>${post.title}</td>
                    <td>${post.cat_name}</td>
                    <td>
                        <i class="fa fa-clock-o" aria-hidden="true">
                        ${post.post_date} 
                    </td>
                    <td>
                        <button type="submit" class="btn delete" onclick="delete_post(${post.post_id},${post.user_id})" ><i class="fa fa-trash" aria-hidden="true"></i></button>
                        <button type="submit" class="btn edit" onclick="data_update_post(${post.post_id})" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                    </td>
                </tr>`;
        rb++;
    }
    html += `</tbody>
    </table>
</div>`;
    $('#acc-content').html(html);
}

function print_admin_cats(cats){
    let rb = 1;
    let html = `<div class="my-posts">
                    <table class="table-user user-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>`;
    for(cat of cats){
        html+= `<tr>
                    <td>${rb}</td>
                    <td>${cat.category_name}</td>
                    <td>
                        <button type="submit" class="btn delete" onclick="delete_category(${cat.category_id})" ><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </button>
                    </td>
                </tr>`;
    rb++;
    }
    html += `</tbody>
    </table>
</div>`;
    $('#acc-content').html(html);
}

function print_category_add(){
    let html = `<div class="form-container acc-form">
                        <div class="form-inner">
                            <ul class="acc-form">
                                <li><h2>Add a category</h2></li>
                                <li><form action="" method="POST" id="post-form"></li>
                                <li><input id="title" type="text" placeholder="Title" required></li> 
                                <li>
                                    <button id="post_submit" type="submit" class="btn-login" onclick="add_category()" >Submit</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>`;
    $('#acc-content').html(html);
}

function print_acc_npost(cats,user_id){
    let html = `<div class="form-container acc-form">
                        <div class="form-inner">
                            <ul class="acc-form">
                                <li><h2>Add a post</h2></li>
                                <li><form action="" method="POST" id="post-form"></li>
                                <li><input id="title" type="text" placeholder="Title" required></li> 
                                <li><textarea id="content" placeholder="Your content goes here..." required></textarea></li>
                                <li><label>Post Category:</label>
                                    <select id="post_cat" name="post_cat">
                                    <option value="0">Choose</option>`;
    for(cat of cats){
        html += `<option value="${cat.category_id}">${cat.category_name}</option>`;
    }
    
    html += `</select>
            </li>
            <li>
                <button id="post_submit" type="submit" class="btn-login" onclick="add_post(${user_id})" >Submit post</button>
                </form>
            </li>
        </ul>
    </div>
</div>`;
    $('#acc-content').html(html);
}

function print_acc_upd_post(cats,post){

    let html = `<div class="form-container acc-form">
                        <div class="form-inner">
                            <ul class="acc-form">
                                <li><h2>Edit your post</h2></li>
                                <li><form action="" method="POST" id="post-form"></li>
                                <li><input id="upt_title" type="text" placeholder="Title" required></li> 
                                <li><textarea id="upt_content" placeholder="Your content goes here..." required></textarea></li>
                                <li><label>Post Category:</label>
                                    <select id="upt_post_cat" name="post_cat">
                                    <option value="0">Choose</option>`;
    for(cat of cats){
        html += `<option value="${cat.category_id}">${cat.category_name}</option>`;
    }
    
    html += `</select>
            </li>
            <li>
                <button id="post_submit" type="submit" class="btn-login" onclick="update_post(${post})" >Submit post</button>
                </form>
            </li>
        </ul>
    </div>
</div>`;
    $('#acc-content').html(html);
}

function post_edit_fill(post_data){
    //console.log(user_data);
    for(data of post_data){
        $('#upt_title').val(data.title);
        $('#upt_content').val(data.content);
        $('#upt_post_cat').val(data.category_id);
    }
}

function print_pagination(num_of_pages){
    let html = "";
    for(let i = 0; i < num_of_pages; i++){
        html += `<li>
                <a href="#" class="post-pag" data-limit="${ i }">
                    ${ i + 1 }
                </a>
            </li>`;
    }
    $("#pag-list").html(html);
}

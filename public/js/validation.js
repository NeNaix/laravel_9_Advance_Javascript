$(document).ready(function() {


var validationLogin = $('#login_form').validate({
     rules: {
       email: { required:true, email:true },
       password: { required:true , minlength:6},
    }
});

var validationRegCustomer = $('#reg_customer_form').validate({
     rules: {   
       fname: { required:true, minlength:3 },
       lname: { required:true, minlength:2 },
       email: { required:true, email:true },
       password: { required:true ,minlength:6 },
       password_confirmation: { required:true ,minlength:6 },
       address: { required:true,},
    }
});

var validationRegEmployee = $('#reg_employee_form').validate({
     rules: {   
       fname: { required:true, minlength:5 },
       lname: { required:true, minlength:5 },
       email: { required:true, email:true },
       password: { required:true ,minlength:6 },
       password_confirmation: { required:true ,minlength:6 },
       address: { required:true,},
    }
});


var validationUpdateCustomer = $('#form_update_customer').validate({
     rules: {   
       update_fname_customer: { required:true, minlength:5 },
       update_lname_customer: { required:true, minlength:5 },
       update_email_customer: { required:true, email:true },
       password: { required:true ,minlength:6 },
       address: { required:true,},
    }
});


var validationUpdateEmployee= $('#form_update_employee').validate({
     rules: {   
       update_fname_employee: { required:true, minlength:3 },
       update_lname_employee: { required:true, minlength:2 },
       update_email_employee: { required:true, email:true },
       password: { required:true ,minlength:6 },
       address: { required:true},
    }
});



var validationForGames = $('#form_create_game').validate({
     rules: {
  	   title: { required:true, minlength:3 },
       description: { required:true, minlength:4 },
       genre_id: { required:true },
       price: { required:true, number:true ,max:10000},
       platform: { required:true},
       stocks: { required:true, number:true ,max:500},
   	}
});

var validationForUpdateGames = $('#form_update_game').validate({
     rules: {
       update_title: { required:true, minlength:3 },
       update_description: { required:true, minlength:4 },
       update_genre_id: { required:true },
       update_price: { required:true, number:true ,max:10000},
       update_platform: { required:true},
       update_stocks: { required:true, number:true ,max:500},
    }
});

var validationForGenre = $('#form_create_genre').validate({
     rules: {
       genre: { required:true, minlength:3 },
    }
});

var validationForUpdateGenre = $('#form_update_genre').validate({
     rules: {
       update_genre: { required:true, minlength:3 },
    }
});


////////////////////////////////////////////////////////////////////	 
    validationLogin.form();
    validationRegCustomer.form();
    validationRegEmployee.form();
    validationUpdateCustomer.form();
    validationUpdateEmployee.form();
    validationForGames.form();
    validationForUpdateGames.form();
    validationForGenre.form();
    validationForUpdateGenre.form();

});
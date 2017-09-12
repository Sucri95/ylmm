$(function()
{
	// validate signup form on keyup and submit
	$("#validateSubmitForm").validate({
		rules: {
			//User's Validators
			name:"required",
			provincia:"required",
			password: {
				required: true,
				minlength: 5,
				maxlength: 15
			},
			confirm_password: {
				required: true,
				minlength: 5,
				maxlength: 15,
				equalTo: "#password"
			},
			email: {
				required: true,
				email: true
			},
			topic: {
				required: "#newsletter:checked",
				minlength: 2
			},
			agree: "required"
		},
		messages: {

			name:"",
			provincia:"",
			email:"",
			password: {
				required: "",
				minlength: "",
				maxlength: ""
			},
			confirm_password: {
				required: "",
				minlength: "",
				maxlength: "",
				equalTo: ""
			},
		}
	});
});
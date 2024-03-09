function send_message() {
	var name=jQuery("#name").val();
	var email=jQuery("#email").val();
	var mobile=jQuery("#mobile").val();
	var message=jQuery("#message").val();
	
	if (name=="") {
		alert('Please enter name');
	} else if (email=="") {
		alert('Please enter email');
	} else if (mobile=="") {
		alert('Please enter mobile');
	} else if (message=="") {
		alert('Please enter message');
	} else {
		jQuery.ajax( {
			url:'send_message.php',
			type:'post',
			data:'name='+name+'&email='+email+'&mobile='+mobile+'&message='+message,
			success:function(result) {
				alert(result);
			}	
		});
	}
}

function user_register() {
	jQuery('.field_error').html('');
	var name=jQuery("#name").val();
	var email=jQuery("#email").val();
	var is_email_verified=jQuery('#is_email_verified').val();
	var password=jQuery("#password").val();
	var is_error='';

	if (name=="") {
		jQuery('#name_error').html('Please enter name');
		is_error='yes';
	} 
	if (email=="") {
		jQuery('#email_error').html('Please enter email');
		is_error='yes';
	}
	if (is_email_verified=="") {
		jQuery('#email_error').html('Please verified your email!');
		is_error='yes';
	}
	if (password=="") {
		jQuery('#password_error').html('Please enter password');
		is_error='yes';
	}
	if (is_error=='') {
		jQuery.ajax({
			url:'register_submit.php',
			type:'post',
			data:'name='+name+'&email='+email+'&password='+password,
			success:function(result) {
				result=result.trim();
				if (result=='email_present') {
					jQuery('#email_error').html('Email id already present');
				} else {
					// jQuery('.register_msg p').html('Thank you for registeration');
					alert('Thank you for registeration');
					window.location.href=window.location.href;
				}
			}	
		});
	}
}

function user_login() {
	jQuery('.field_error').html('');
	var email=jQuery("#login_email").val();
	var password=jQuery("#login_password").val();
	var is_error='';

	if (email=="") {
		jQuery('#login_email_error').html('Please enter email');
		is_error='yes';
	} if (password=="") {
		jQuery('#login_password_error').html('Please enter password');
		is_error='yes';
	} if (is_error=='') {
		jQuery.ajax({
			url:'login_submit.php',
			type:'post',
			data:'email='+email+'&password='+password,
			success:function(result) {
				result=result.trim();
				if (result=='wrong') {
					jQuery('.login_msg p').html('Please enter valid login details');
				}
				if (result=='valid') {
					window.location.href=window.location.href;
				}
			}	
		});
	}	
}

function manage_cart_update(pid,type) {
	manage_cart(pid,type);
}

function manage_cart(pid,type,is_checkout) {
	var is_error='';
	if (type=='update') {
		var qty=jQuery("#"+pid+"qty").val();
	} else {
		var qty=jQuery("#qty").val();
	}
	if (type=='add') {
		var cart_qty=1;
	
	};
	if (is_error=='') {
		jQuery.ajax({
			url:'manage_cart.php',
			type:'post',
			data:'pid='+pid+'&qty='+qty+'&type='+type,
			success:function(result) {
				result=result.trim();
				if (type=='update' || type=='remove') {
					window.location.href=window.location.href;
				};
				if (result=='not_avaliable') {
					alert('Qty not avaliable');	
				} else {
					jQuery('.htc__qua').html(result);
					if (is_checkout=='yes') {
						window.location.href='checkout.php';
					}
				}
			}	
		});	
	}
}

function sort_product_drop(cat_id,site_path) {
	var sort_product_id=jQuery('#sort_product_id').val();
	window.location.href=site_path+"categories.php?id="+cat_id+"&sort="+sort_product_id;
}

function wishlist_manage(pid,type) {
	jQuery.ajax({
		url:'wishlist_manage.php',
		type:'post',
		data:'pid='+pid+'&type='+type,
		success:function(result){
			result=result.trim();
			if (result=='not_login') {
				window.location.href='login.php';
			} else {
				jQuery('.htc__wishlist').html(result);
			}
		}	
	});	
}

function loadAttr(c_s_id,pid){
	jQuery('#cart_qty').addClass('hide');
	jQuery('#cid').val(c_s_id);				
	if (is_size==0) {
		jQuery('#cart_attr_msg').html('');
		jQuery('#cart_qty').removeClass('hide');
		getAttrDetails(pid);
	} else {
	jQuery('#cart_attr_msg').html('');
	jQuery.ajax({
		url:'load_attr.php',
		type:'post',
		data:'&pid='+pid,
		});	
	}
}

function showQty() {
	getAttrDetails(pid);
}

function getAttrDetails(pid) {
	jQuery('#cart_qty').hide();

	jQuery.ajax({
		url:'getAttrDetails.php',
		type:'post',
		data:'pid='+pid,
		success:function(result) {
			result=jQuery.parseJSON(result);
			jQuery('.price').html(result.price);
			var qty=result.qty;
			
			if (qty>0) {
				var html='';
				for (i=1;i<=qty;i++) {
					html=html+"<option>"+i+"</option>";
				}
				jQuery('#cart_qty').show();
				jQuery('#qty').html(html);
				jQuery('#cart_attr_msg').html('');
				jQuery('#cart_qty').removeClass('hide');
			} else {
				jQuery('#cart_attr_msg').html('Out of stock');
			}
		}
	});
}
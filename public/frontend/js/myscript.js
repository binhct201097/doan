$(document).ready(function() {
	$(".updatecart").click(function() {
		var rowId = $(this).attr('id');
		var qty = $(this).parent().parent().find(".qty").val();
		var token = $("input[name='_token']").val();
		$.ajax({
			url:'cap-nhat-san-pham/'+rowId+'/'+qty,
			type:'GET',
			cache:false,
			data:{"_token":token,"id":rowId,"qty":qty},
			success:function (data) {
				if(data == "oke") {
					window.location = "gio-hang";
				}
				else {
					alert("Error!");
				}
			}
		});
	});
});

//carousel-postOfBlog
$('.owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
    nav: false,
    responsive: {
        0: {
            items: 1
        },
        767: {
            items: 2
        },
        1000: {
            items: 3
        }
    }
});
$(function(){


			// Filter buton event fire on click
			$('#filter').click(function(e){

				e.preventDefault();
				// to prevent relode page
				var data = $('#filter-form').serialize();
				$.ajax({
			        url: "index.php/report/getData",
			        type: "get",
			        data: data ,
			        dataType  : 'json',
			        success: function (response) {
			    	// Response get from ajax requeset
			       		// selector of table
			       		var report =$('#report-data');

			        	if (response.report) {
			        		$html ='';
			        		for (var i = 0; i < response.report.length; i++) {
			        			$html +='<tr>'
							        $html +='<td>'+response.report[i].invoice_num+'</td>'
							        $html +='<td>'+response.report[i].invoice_date+'</td>'
							        $html +='<td>'+response.report[i].product_description+' </td>'
							        $html +='<td>'+response.report[i].qty+' </td>'
							        $html +='<td>'+response.report[i].price+' </td>'
									$html +='<td>'+response.report[i].total+' </td>'
							      $html +='</tr>'

			        		};
			        		// set html after genrating html using jquery
			        		$('#report-data').html($html);
			        		$('#pagination').html(response.pagination);
			        		
			        	};	



			        },
			        error: function(jqXHR, textStatus, errorThrown) {
			        	// if any error comes pass to console
			           console.log(textStatus, errorThrown);
			        }


			    });
			});


			
			$('#clients').change(function(){
				data = {
					'clients_id' : $(this).val()
				}
				$.ajax({
			        url: "index.php/products",
			        type: "get",
			        data: data ,
			        dataType  : 'json',
			        success: function (response) {

			        	var product_id =$('#products').val();

			        	if (response.products) {
			        		$html = '<option value="">Select Product</option>';
			        		for (var i = 0; i < response.products.length; i++) {
			        			$html +='<option value="'+response.products[i].product_id+'">'+response.products[i].product_description+'</option>';
			        		};
			        		$('#products').html($html);
			        		$("#products").val(product_id);
			        	};
			        },
			        error: function(jqXHR, textStatus, errorThrown) {
			        	// if any error comes pass to console
			           console.log(textStatus, errorThrown);
			        }


			    });
			});



			

			
		});


$('body').on('click', '#pagination a', function(e) {
	// pagination click ajax request 
	e.preventDefault();
	var url = $(this).attr("href");
	// get url of that paginations
	var data = $('#filter-form').serialize();
	  $.ajax({
	    type: "GET",
	    data: data,
	    url: url,
	   	success: function(response) {

	     	var report =$('#report-data');

	        	if (response.report) {
	        		$html ='';
	        		for (var i = 0; i < response.report.length; i++) {
	        			$html +='<tr>'
					        $html +='<td>'+response.report[i].invoice_num+'</td>'
					        $html +='<td>'+response.report[i].invoice_date+'</td>'
					        $html +='<td>'+response.report[i].product_description+' </td>'
					        $html +='<td>'+response.report[i].qty+' </td>'
					        $html +='<td>'+response.report[i].price+' </td>'
							$html +='<td>'+response.report[i].total+' </td>'
					      $html +='</tr>'

	        		};
	        		// set html after genrating html using jquery	
	        		$('#report-data').html($html);
	        		$('#pagination').html(response.pagination);
	        		
	        	};	
	    }
	});
	return false;

});
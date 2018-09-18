$(function(){
	$.getJSON('/api/balance', function(data){

		$('.current-balance').html(data.balance + ' EUR');
	});

	$('.debt-rows-table').DataTable({
		processing: true,
		serverSide: true,
		ajax: '/api/debts.json',
		searching: false,

		columns: [
			{ data: 'id' },
			{ data: 'title' },
			{ data: 'value', className: 'text-right' },
			{ data: 'date', className: 'text-right' }
		],
		pageLength: 10
	});

	$('.payment-rows-table').DataTable({
		processing: true,
		serverSide: true,
		ajax: '/api/payments.json',
		searching: false,

		columns: [
			{ data: 'id' },
			{ data: 'value', className: 'text-right' },
			{ data: 'date', className: 'text-right' }
		],
		pageLength: 10
	});
});

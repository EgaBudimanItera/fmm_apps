
function dk_hitung_bruto()
{   
    var $debitx=$('.dk-stagging-debit');
	var $creditx= $('.dk-stagging-credit');
    var $amountx = $('.dk-stagging-amount');
    var $idx=$('.dk-stagging-id');
    var total=0;
    var amount=0;
    
    $.each ($idx, function(i, o) {
        var debit = parseInt($($debitx[i]).val());
        var credit = parseInt($($creditx[i]).val());
        
        
        if (isNaN(debit)) {
			debit = 0;
		}
		
		if (isNaN(credit)) {
			credit = 0;
		}

       
        amount=debit-credit;
        $($amountx[i]).val(amount);

        total = total + amount;

    });
	$('.dk-stagging-total').val(total);
	
}
function filterData(){
    // alert('a');
    var cust=$('#cust').val() != '' ? $('#cust').val() : 'kosong';
    var branchid=$('#branchid').val() != '' ? $('#branchid').val() : 'kosong';
    var year=$('#year').val() != '' ? $('#year').val() : 'kosong';
    var grupcd=$('#grupcd').val() != '' ? $('#grupcd').val() : 'kosong';
    var vendor=$('#vendor').val() != '' ? $('#vendor').val() : 'kosong';
    if(cust=="kosong"){
        alert('Customer Tidak Boleh Kosong');
        return false;
    }
    if(branchid=="kosong"){
        alert('Branch Tidak Boleh Kosong');
        return false;
    }
    if(year=="kosong"){
        alert('Tahun Tidak Boleh Kosong');
        return false;
    }
    if(grupcd=="kosong"){
        alert('Grup CD Tidak Boleh Kosong');
        return false;
    }
    if(vendor=="kosong"){
        alert('Vendor Tidak Boleh Kosong');
        return false;
    }
    var $table = $('.dk-stagging-table');
    var input={'cust':cust,'branchid':branchid,
			'year':year,'grupcd':grupcd};
    
    $.post (
        site_url+'/dasboard/ajax_stagging'
        , { 'cust':cust,'branchid':branchid,
        'year':year,'grupcd':grupcd,'vendor':vendor}
        , function(response) {
            $table.find('tbody tr').remove();
            // parse = $.parseJSON(response);
            var markup="";
            var tanda="1";
            $.each(response, function(name, value) {
                // console.log(response);
                var id=value.id;
                var BranchCD=value.BranchCD;
                var FinPeriodID=value.FinPeriodID;
                var Year=value.Year;
                var BatchNbr=value.BatchNbr;
                var GroupCD=value.GroupCD;
                var Vendor=value.Vendor;
                var debit=value.debit;
                var credit=value.credit;
                var amount=value.amount;
                tanda='2';
                var isi="";

                isi='<tr>'+
                            
                    '<td>'+
                        '<input type="hidden" name="stagging[id][]" class="form-control dk-stagging-id" value="'+id+'"  style="width:100%" readonly >'+
                        '<input type="text" name="stagging[BranchCD][]" class="form-control" value="'+BranchCD+'"  style="width:100%"  >'+
                    '</td>'+
                    '<td><input type="text" name="stagging[FinPeriodID][]" class="form-control" style="width:100%" value="'+FinPeriodID+'" ></td>'+
                    '<td><input type="text" name="stagging[Year][]" class="form-control" style="width:100%" value="'+Year+'" ></td>'+
                    '<td><input type="text" name="stagging[BatchNbr][]" class="form-control" style="width:100%" value="'+BatchNbr+'" ></td>'+
                    '<td><input type="text" name="stagging[GroupCD][]" class="form-control" style="width:100%" value="'+GroupCD+'" ></td>'+
                    '<td><input type="text" name="stagging[Vendor][]" class="form-control" style="width:100%" value="'+Vendor+'" ></td>'+
                    '<td>'+
                        '<input type="text" name="stagging[debit][]"  class="control-number-digit dk-stagging-debit" style="width:100%" value="'+debit+'">'+
                    '</td>'+
                    '<td>'+
                        '<input type="text" name="stagging[credit][]"  class="control-number-digit dk-stagging-credit" style="width:100%" value="'+credit+'">'+
                    '</td>'+
                    '<td>'+
                        '<input type="text" name="stagging[amount][]"  class="control-number-digit dk-stagging-amount" style="width:100%" value="'+amount+'">'+
                    '</td>'+
                    
                '</tr>';
                markup=markup.concat(isi.toString());
                
                
            });
            var isibawah="";
            if(tanda=='2'){
                isibawah='<td colspan="8"> TOTAL </td>'+
                    '<td>'+
                        '<input type="text" name="stagging[total][]"  class="control-number-digit dk-stagging-total" style="width:100%" value="">'+
                    '</td>';
                markup=markup.concat(isibawah.toString());
            }
            
            console.log(markup);
            tableBody = $(".dk-stagging-table tbody");
            tableBody.append(markup);
            dk_hitung_bruto();
            $('.select2').select2({ allowClear: true });
            $('input.control-number-no').number(true, 0);
            $('input.control-number-digit').number(true, 2);
            $('input').attr('autocomplete', 'off');
        }
    );
}


$().ready(function() {
    $('.dk-stagging-table').on('keyup', '.dk-stagging-debit', dk_hitung_bruto);
    $('.dk-stagging-table').on('keyup', '.dk-stagging-credit', dk_hitung_bruto);
    
});
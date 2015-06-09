<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <td class="text-left">Payment Method</td>
                <td class="text-left">Status</td>
                <td class="text-right">Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
            <tr>
                <td class="text-left">{{ucwords($payment->payment_type)}}</td>
                <td class="text-left">{{$payment->is_status}}</td>
                <td class="text-right">                  
                    <a class="btn btn-primary" title="" data-toggle="tooltip" href="{{url('backend/options/editpayment/'.$payment->id)}}" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
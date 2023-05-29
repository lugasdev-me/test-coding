<div>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">ORDER ID</th>
            <th scope="col">amount</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($orders as $order)
          <tr>
            <th scope="row">{{$order->id}}</th>
            <td>{{$order->order_id}}</td>
            <td>{{$order->amount}}</td>
            <td>{{$order->status}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
</div>

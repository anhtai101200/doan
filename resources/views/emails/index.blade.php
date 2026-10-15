<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin đơn hàng!</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f4f4; font-family:Arial,sans-serif;">
    <p>{{ $data['body'] }}</p>
    <div class="table-responsive cart_info">
            <table width="100%" cellpadding="8" cellspacing="0" border="0"
                style="background-color:#f4f4f4; padding:20px 0;" class="table table-condensed">
                <thead>
                    <tr style="background-color:#FE980F; color:#ffffff;" class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach($cart as $product)
                    <tr>
                        <td class="cart_product">
                            @php
                                $getArrImage = json_decode($product['hinhanh'], true);
                            @endphp

                            @if(!empty($getArrImage))
                                <a href=""><img src="{{ url('upload/product/image/' .$getArrImage[0]) }}" alt="" width="80" height="80" style="object-fit: cover;"></a>
                            @endif
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{ $product['name'] }}</a></h4>
                            <p>Web ID: {{ $product['id'] }}</p>
                        </td>
                        <td class="cart_price">
                            <p>${{ number_format($product['price'])}}</p>
                        </td>
                       
                        <td class="cart_total">
                            <p class="cart_total_price"> ${{ number_format((float)$product['price'] * (int)$product['qty']) }}</p>
                        </td>
                       
                    </tr>
                    @php
                        $total += (float)$product['price'] * (int)$product['qty'];
                    @endphp
                    @endforeach

                </tbody>
            </table>
        </div>
     
</body>
</html>
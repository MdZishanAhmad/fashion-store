<!DOCTYPE html>
<html>
<head>
    <title>eSewa V2 Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 50px auto;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input[type="text"], input[type="url"] {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            box-sizing: border-box;
        }
        button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #00A651;
            color: white;
            border: none;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #007E3A;
        }
    </style>
</head>
<body>
    <h2>Pay with eSewa</h2>

    <form method="POST" action="https://rc-epay.esewa.com.np/api/epay/main/v2/form">
        <label>Amount</label>
        <input type="text" name="amount" value="{{ $amount }}" readonly>

        <label>Tax Amount</label>
        <input type="text" name="tax_amount" value="0" readonly>

        <label>Total Amount</label>
        <input type="text" name="total_amount" value="{{ $amount }}" readonly>

        <label>Transaction UUID</label>
        <input type="text" name="transaction_uuid" value="{{ $product_id }}" readonly>

        <label>Product Code (Merchant Code)</label>
        <input type="text" name="product_code" value="{{ $merchant_code }}" readonly>

        <label>Product Service Charge</label>
        <input type="text" name="product_service_charge" value="{{ $service_charge }}" readonly>

        <label>Product Delivery Charge</label>
        <input type="text" name="product_delivery_charge" value="{{ $delivery_charge }}" readonly>

        <label>Success URL</label>
        <input type="url" name="success_url" value="{{ $success_url }}" readonly>

        <label>Failure URL</label>
        <input type="url" name="failure_url" value="{{ $failure_url }}" readonly>

        <label>Signed Field Names</label>
        <input type="text" name="signed_field_names" value="total_amount,transaction_uuid,product_code" readonly>

        <label>Signature</label>
        <input type="text" name="signature" value="{{ $signature }}" readonly>

        <button type="submit">Pay with eSewa</button>
    </form>
</body>
</html>

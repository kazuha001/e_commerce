<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/default.css">
</head>

<body>
<?php

include 'server.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_SESSION["username"])) {

        include 'encrypt.php';
        include 'key.php';

        $session = decryptPrize($_SESSION["username"], $key);

        $check = $conn->prepare("SELECT * FROM user_accounts WHERE username = ?");
        $check->bind_param("s", $session);
        $check->execute();
        $check_result = $check->get_result();

        if ($check_result->num_rows > 0) {

            $check_acc = $check_result->fetch_assoc();

            echo '<div id="print" style="width: 830px; height: auto; display: flex;
                    justify_content: center; flex-flow: column; background-color: #d9d9d9;">';
                    echo '<div style="padding: 20px;"><h1>Reciept.....  id.....' . $check_acc["id"] . ' username....' . $check_acc["username"] . '</h2></div>';
                    echo '
                        <div><h1>--------------------------------------------------------------------------</h2></div>';
                    echo '<table>';
                    echo ' <thead>
                        <th>Trans ID</th>
                        <th>Shop</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Payment Method</th>
                    </thead>
                    <tbody>';
            echo '<script>
                        alert("Printing this Data will be Destroy!!!")
                        window.print()
                        window.location.href = "complete.php"
            </script>';

            $trans = $conn->prepare("SELECT * FROM trans WHERE user_id = ?");
            $trans->bind_param("i", $check_acc["id"]);
            $trans->execute();
            $trans_result = $trans->get_result();
            
            if ($trans_result->num_rows > 0) {

                $trans_acc = $trans_result->fetch_all(MYSQLI_ASSOC);

                $result = 0;

                $tax = 0;

                foreach ($trans_acc as $row) {

                    echo '
                    <tr>
                        <td style="text-align: center; height: 30px;">' . $row["id"] . '</td>
                        <td style="text-align: center; height: 30px;">' . $row["shop_name"] . '</td>
                        <td style="text-align: center; height: 30px;">' . $row["product_name"] . '</td>
                        <td style="text-align: center; height: 30px;">' . $row["pr_price"] . '</td>
                        <td style="text-align: center; height: 30px;">' . $row["qty"] . '</td>
                        <td style="text-align: center; height: 30px;">' . $row["prize"] . '</td>
                        <td style="text-align: center; height: 30px;">' . $row["bank"] . '</td>
                    </tr>
                    ';

                }
                
                $result += $row["prize"];
                $tax += $row["tax"];

            }
            echo '</tbody>
                    </table> 
                    <div style="padding: 20px;"><h2> Fee: ' . $tax . ' |||| Total: ' . $result . '     ||||||||||||||||</h2></div>
                    <div style="padding: 10px;"><p>Date: ' . $row["date"] . '</p></div>
                    ';
            echo '</div>';

            $destroy = $conn->prepare("DELETE FROM trans WHERE user_id = ?");
            $destroy->bind_param("i", $check_acc["id"]);
            $destroy->execute();


        } else {

            
        }



    } else {

        

    }


} else {

    
}




?>

</body>
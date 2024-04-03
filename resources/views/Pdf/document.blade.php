<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Certificate</title>
    <style>
        /* html{
        padding: 0;
        margin: 0;
      } */

        body {
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            margin: 0;
        }

        p {
            font-family: inherit;
        }

        .certificate {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 87%;
            height: 82.7%;
            text-align: center;
            margin: 1.5%;
            padding: 5%
        }
       
        .header h2 {
            margin-bottom: 30px;
            position: relative;
            top: 40px;
            text-transform: uppercase;
            font-weight: bold;
        }


        .body {
            margin:  50px;
        }

        .info {
            margin-bottom: 20px;
        }
        h3{
           margin-bottom: 5%;
        }

        .signature {
            width: 75%;
            float: left;
            text-align: left;
        }
        .date {
            width: 25%;
            float: right;
            text-align: left;

        }
        .underline{
            text-decoration: underline;
        }
        .signature-line {
            width: 140px;
            height: 40px;
            border-bottom: 1px solid #ccc;
            margin-top: 10px;
        }

        .certificate-container {
            position: relative;
            width: 100%;
            height: 100%;
            margin: 0;
            background-color: #618597;
            color: #333;
            font-family: "Open Sans", sans-serif;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
        }

        .certificate-border {
            position: absolute;
            width: 70%;
            height: 77%;
            padding: 0;
            border: 1px solid #fff;
            background-image: none;
            left: 0%;
            top: 0%;
            margin: 8% 15%;
        }

        .o-border {
            width: 98%;
            height: 98%;
            position: absolute;
            left: 0;
            /* margin-left: 5%; */
            top: 0;
            margin: .5% 1%;
            border: 2px solid #fff;
        }

        .i-border {
            width: 80%;
            height: 85%;
            position: absolute;
            left: 0;
            top: 0;
            margin: 5% 10%;
            border: 2px solid #fff;
        }
    </style>
</head>

<body>
    <div class="certificate-container">
        <div class="o-border"></div>
        <div class="i-border"></div>
        <div class="certificate-border">
            <div class="certificate">
                <div class="header">
                    <h2>Omishitu Joy Certificate of Completion</h2>
                </div>
                <div class="body">
                    <div class="info">
                        <h3  class="underline" >{{$title}}</h3>
                        <p>EARNED THIS CERTIFICATION</p>
                        <p>WHILE COMPLETING THE TRAINING COURSE ENTITLED</p>
                        <h3  class="underline">
                            {{$course}}
                        </h3>
                    </div>
                </div>
                <div class="signature">
                    <p>Signature:</p>
                    <div class="signature-line"></div>
                </div>
                <div class="date">
                    <p>Date:</p>
                    <div class="signature-line"></div>
                </div>
        </div>
    </div>
</body>

</html>

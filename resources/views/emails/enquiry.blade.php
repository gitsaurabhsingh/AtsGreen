<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Website Enquiry</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f9f9f9; margin: 0; padding: 20px; color: #333; }
        .wrapper { max-w-width: 600px; margin: 0 auto; background: #ffffff; padding: 40px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .logo { text-align: center; font-size: 24px; font-weight: bold; margin-bottom: 30px; color: #000; }
        h1 { font-size: 22px; color: #000; margin-top: 0; margin-bottom: 20px; font-weight: bold; }
        .text { font-size: 16px; color: #555; line-height: 1.5; margin-bottom: 25px; }
        .details-heading { font-size: 16px; font-weight: bold; color: #333; margin-bottom: 10px; }
        ul { margin-top: 0; padding-left: 20px; color: #555; line-height: 1.6; margin-bottom: 25px; font-size: 15px; }
        .btn-container { text-align: center; margin-top: 30px; margin-bottom: 30px; }
        .btn { display: inline-block; padding: 12px 24px; background-color: #111; color: #ffffff !important; text-decoration: none !important; border-radius: 4px; font-weight: 500; font-size: 15px; }
        .btn:hover { background-color: #333; }
        .signature { font-size: 15px; color: #555; line-height: 1.5; margin-top: 20px; }
    </style>
</head>
<body>
    <div style="text-align: center; margin-bottom: 20px;">
        <span style="font-size: 20px; font-weight: bold; font-family: sans-serif; color: #000;">ATS Real Estate</span>
    </div>
    <div class="wrapper">
        <h1>New Website Enquiry</h1>
        
        <p class="text">Hello,</p>
        <p class="text">You have received a new enquiry from the website. Here are the details:</p>
        
        <div class="details-heading">Enquiry Details:</div>
        <ul>
            <li><strong>Name:</strong> {{ $name }}</li>
            <li><strong>Email:</strong> {{ $email }}</li>
            <li><strong>Phone:</strong> {{ $phone }}</li>
            <li><strong>Project:</strong> {{ $project_name ?? 'N/A' }}</li>
        </ul>
        
        <p class="text">Please log in to the admin panel to view all leads.</p>
        
        <div class="btn-container">
            <a href="{{ url('admin/leads') }}" class="btn">View Leads in Admin Panel</a>
        </div>
        
        <div class="signature">
            Thanks,<br>
            ATS Real Estate
        </div>
    </div>
</body>
</html>

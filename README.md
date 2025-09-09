# php-twilio-whatsapp
Quick-start PHP API for WhatsApp messaging with Twilio.  
Just configure your `.env` file, and the API is ready to send messages via the Sandbox.

## Technologies
- PHP 8.2+
- Twilio SDK (PHP)
- phpdotenv for environment variables
- Composer for dependency management

## Run the app
1. composer install

2. Change .env.example to .env, and add real information:
TWILIO_SID → your Twilio Account SID (from Twilio Console)
TWILIO_TOKEN → your Twilio Auth Token
TWILIO_WHATSAPP_NUMBER → leave as the sandbox number whatsapp:+14155238886 (for testing)
API_KEY → any random secure string (this will be used for authorization)

3. Start the PHP development server in the project folder:
php -S localhost:8000

4. Test the API using Postman. Open Postman and create a new POST request to:
http://localhost:8000/send_message.php

- In the Headers tab, add:

Key: Authorization
Value: Bearer YOUR_API_KEY
(replace YOUR_API_KEY with the value from your .env file)

- In the Body tab, select raw and JSON, then add:

{
  "phone": "+381641234567",
  "message": "Hello from Twilio WhatsApp API!"
}

**IMPORTANT:**

The phone number must be in E.164 format (+<country_code><number>), e.g., +381641234567.
If you are using the Twilio Sandbox, the recipient number must be verified in your Twilio Sandbox.
To verify a number, follow Twilio’s Sandbox instructions (send the join code from Twilio via WhatsApp).
The TWILIO_WHATSAPP_NUMBER in .env should remain as the sandbox number: whatsapp:+1234567890 (This is an example number, use a number that you verified) for testing.

- Press Send. if everything is correct, you will receive:

{
  "status":
  "Message sent"
}

If you get {"error":"Unauthorized"}, check that your Authorization header matches API_KEY.
If you get {"error":"Internal error"}, verify your Twilio SID, token, sandbox number, and that the recipient number is verified.

![photo_2025-07-21_15-58-58](https://github.com/user-attachments/assets/00995ab7-9303-4858-94f5-f4375f691a35)

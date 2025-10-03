import { functions } from 'firebase-functions';
import * as nodemailer from 'nodemailer';

const transporter = nodemailer.createTransport({
  service: 'gmail',
  auth: {
    user: process.env.EMAIL_USER,
    pass: process.env.EMAIL_PASS,
  },
});

export const sendOrderConfirmation = async (orderData, userEmail) => {
  const mailOptions = {
    from: process.env.EMAIL_USER,
    to: userEmail,
    subject: 'Order Confirmation',
    html: `
      <h1>Thank you for your order!</h1>
      <p>Order ID: ${orderData.id}</p>
      <p>Total: $${orderData.total}</p>
    `
  };

  return transporter.sendMail(mailOptions);
};

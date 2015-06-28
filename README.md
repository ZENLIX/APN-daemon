# APN-daemon
APN php daemon scripts &amp; tutorial

For generate certeficate:
<pre>
sudo openssl s_client -connect gateway.sandbox.push.apple.com:2195
sudo openssl pkcs12 -clcerts -nokeys -out apns-dev-cert.pem -in Certificate.p12
sudo openssl pkcs12 -nocerts -out apns-dev-key.pem -in Certificate.p12
openssl rsa -in apns-dev-key.pem -out apns-dev-key-noenc.pem
sudo openssl rsa -in apns-dev-key.pem -out apns-dev-key-noenc.pem
cat apns-dev-cert.pem apns-dev-key-noenc.pem > apns-dev.pem
</pre>

--


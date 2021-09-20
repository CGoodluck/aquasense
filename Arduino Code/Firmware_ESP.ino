//  Firmware_ESP.ino
//  Aquasense
//
//  Created by Christopher Goodluck on 05/01/2021.
//  Copyright (c) 2021 All rights reserved.

#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>

ESP8266WiFiMulti WiFiMulti;

String data = "NULL";

void setup() {
  
    Serial.begin(9600);    

    // We start by connecting to a WiFi network
    WiFi.mode(WIFI_STA);
    WiFiMulti.addAP("GGuest", "goodluck");

    Serial.println();
    Serial.println();
    Serial.print("Wait for WiFi... ");

    while(WiFiMulti.run() != WL_CONNECTED) {
        Serial.print(".");
        delay(500);
    }

    Serial.println("");
    Serial.println("WiFi connected");
    Serial.println("IP address: ");
    Serial.println(WiFi.localIP());

    delay(500);
}


void loop()
{
  const uint16_t httpPort = 80;
  const char * host = "192.168.1.3"; // ip or dns

    Serial.print("connecting to ");
    Serial.println(host); 

    // Use WiFiClient class to create TCP connections
    WiFiClient client;

    if (!client.connect(host, httpPort)) {
        Serial.println("connection failed");
        Serial.println("wait 5 sec...");
        delay(5000);
        return;
    }

    //getting Sensor data from Arduino Board

    data = Serial.readString();

    //data = "wtemp=34&ph=35&wlevel=36&atemp=37&humidity=38&light=39";
    
    Serial.println(data);

    // This will send the request to the server
    client.print(String("POST http://192.168.1.3/aquasense/connect.php?") 
                          + data +
                          " HTTP/1.1\r\n" +
                 "Host: " + host + "\r\n" +
                 "Connection: close\r\n\r\n");

    unsigned long timeout = millis();


    while (client.available() == 0) {
        if (millis() - timeout > 1000) {
            Serial.println(">>> Client Timeout !");
            client.stop();
            return;
        }
    }

    Serial.println();
    Serial.println("closing connection");

    delay (300000); // 5 minutes
    
}

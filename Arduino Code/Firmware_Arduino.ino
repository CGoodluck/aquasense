//  Firmware_Arduino.ino
//  Aquasense
//
//  Created by Christopher Goodluck on 05/01/2021.
//  Copyright (c) 2021 All rights reserved.

#include <OneWire.h>
#include <DallasTemperature.h>
#include <SoftwareSerial.h> //Included SoftwareSerial Library
#include <dht.h>

#define WT_PIN 40 //Digital Pin 3    - Water Temp.
#define PH_PIN A0 //Analog Pin A0    - pH
#define WL_PIN A2 //Analog Pin A2   - Water Level
#define SEN_PWR 42 // Water Level Power
#define AH_PIN 44 //Digital Pin 5    - Air/Humidity
#define L_PIN A4 //Analog Pin A4     - Light

OneWire oneWire(WT_PIN);
DallasTemperature sensors(&oneWire);
dht DHT;

//Started SoftwareSerial at RX and TX pin of ESP8266/NodeMCU
SoftwareSerial s(1, 0); //Rversing RX and TX (TX,RX)

float WT_val = 0.0;
unsigned long int PH_avgValue = 0;  //Store the average value of the sensor feedback
int PH_buf[10];
int PH_temp = 0;
int WL_val = 0;
int L_val = 0;

String sensor_data = "NULL";
String WL_string = "NULL";
String L_string = "NULL";

void getSensorData () {

  // ------ Water Temperature ------ //

  sensors.requestTemperatures();
  WT_val = sensors.getTempCByIndex(0);

  // ------ pH ------ //

  for (int i = 0; i < 10; i++) //Get 10 sample value from the sensor for smooth the value
  {
    PH_buf[i] = analogRead(PH_PIN);
    delay(10);
  }
  for (int i = 0; i < 9; i++) //sort the analog from small to large
  {
    for (int j = i + 1; j < 10; j++)
    {
      if (PH_buf[i] > PH_buf[j])
      {
        PH_temp = PH_buf[i];
        PH_buf[i] = PH_buf[j];
        PH_buf[j] = PH_temp;
      }
    }
  }
  PH_avgValue = 0;
  for (int i = 2; i < 8; i++)               //take the average value of 6 center sample
    PH_avgValue += PH_buf[i];
  float phValue = (float)PH_avgValue * 5.0 / 1024 / 6; //convert the analog into millivolt
  phValue = 3.5 * phValue;                  //convert the millivolt into pH value

  delay(1000);

  // ------ Water Level ------ //

  digitalWrite(SEN_PWR, HIGH);  // Turn the sensor ON
  delay(10);              // wait 10 milliseconds
  WL_val = analogRead(WL_PIN);    // Read the analog value form sensor
  digitalWrite(SEN_PWR, LOW);   // Turn the sensor OFF

  if (WL_val < 25){
    WL_string = "CRITICAL";
  }
  else if (WL_val > 25 && WL_val < 100){
    WL_string = "LOW";
  }
  else {
    WL_string = "NORMAL";
  }

  delay(1000);

  // ------ Air Temperature and Humidity ------ //

  int AH_readData = DHT.read11(AH_PIN);

  //float AH_t = DHT.temperature;  // Read temperature
  //float AH_h = DHT.humidity;   // Read humidity
  float AH_t = 30.1;  // Read temperature
  float AH_h = 64;   // Read humidity

  delay(1000);

  // ------ Light ------ //

  L_val = analogRead(L_PIN);

  if (L_val > 850) {
    L_string = "OFF";
  }
  else if (L_val < 150) {
    L_string = "BRIGHT";
  }
  else {
    L_string = "ON";
  }

  // ------ Data to be sent via Serial ------ //

  sensor_data = (String("wtemp=") + WT_val +
                 ("&ph=") + phValue +
                 ("&wlevel=") + WL_string +
                 ("&atemp=") + AH_t +
                 ("&humidity=") + AH_h +
                 ("&light=") + L_string
                );

  s.print(sensor_data);
  //Serial.println(sensor_data);

  delay(210000); // 3.5 minutes
}

void setup() {

  pinMode(SEN_PWR, OUTPUT);
  digitalWrite(SEN_PWR, LOW);
  //Serial.begin(9600);

  s.begin(9600);
  
  sensors.begin();
}

void loop() {

  getSensorData();
}

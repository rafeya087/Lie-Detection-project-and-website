#include <dht.h>

dht DHT;
#include <LiquidCrystal.h>

#include <Arduino_JSON.h>

#define DHT11_PIN 7
void setup() {
  // put your setup code here, to run once:
   Serial.begin(9600);
   Serial.begin(9600);
    pinMode(2, OUTPUT);
    pinMode(3, OUTPUT);
    pinMode(4, OUTPUT);
    digitalWrite(2, HIGH);
    delay(500);
    digitalWrite(3, HIGH);
    delay(500);
    digitalWrite(4, HIGH);
    delay(500);

}

void loop() {
  // put your main code here, to run repeatedly:
  if (analogRead(A0) > 60)
  {
    digitalWrite(4, HIGH);
  }
  else
  {
    digitalWrite(4, LOW);
  }
  if (analogRead(A0) > 20)
  {
    digitalWrite(2, HIGH);
  }
  else
  {
    digitalWrite(2, LOW);
  }
  if (analogRead(A0) > 45)
  {
    digitalWrite(3, HIGH);
  }
  else
  {
    digitalWrite(3, LOW);
  }
  Serial.print("Heart Beat = ");
  Serial.println(analogRead(A0)/6);
  delay(2000);
   int chk = DHT.read11(DHT11_PIN);
  Serial.print("Temperature = ");
  Serial.println(DHT.temperature);
  Serial.print("Humidity = ");
  Serial.println(DHT.humidity);
  delay(3000);
}

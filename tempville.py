# coding: UTF-8

"""
Script: main.py/tempville
Création: admin, le 15/01/2021
"""


# Imports

import datetime
import requests
import mysql.connector





#Fonctions



def set_temperature_bdd(ville, temperature):
    print(temperature, ville)
    cnx = mysql.connector.connect(user='root', password='', host='127.0.0.1', database='bdd_temperaturevilles')
    cursor = cnx.cursor()
    update_temperature = ("UPDATE temperaturevilles SET temperature = (%s) WHERE ville = (%s)")
    data = (temperature, ville)
    cursor.execute(update_temperature, data)
    cnx.commit()
    cursor.close()
    cnx.close()


def set_pression_bdd(ville, pression):
        print(pression, ville)
        cnx = mysql.connector.connect(user='root', password='', host='127.0.0.1', database='bdd_temperaturevilles')
        cursor = cnx.cursor()
        update_pression = ("UPDATE pression SET pression = (%s) WHERE ville = (%s)")
        data = (pression, ville)
        cursor.execute(update_pression, data)
        cnx.commit()
        cursor.close()
        cnx.close()




def get_temperature(ville):
    url="http://api.openweathermap.org/data/2.5/weather?q="+ville+",fr&units=metric&lang=" \
                                                                  "fr&appid=0a73790ec47f53b9e1f2e33088a0f7d0"
    return float(requests.get(url).json()['main']['temp'])

def get_pression(ville):
    url = "http://api.openweathermap.org/data/2.5/weather?q=" + ville + ",fr&units=metric&lang=" \
                                                                        "fr&appid=0a73790ec47f53b9e1f2e33088a0f7d0"
    return float(requests.get(url).json()['main']['pressure'])
# Programme principal
def main():
    ville=["grenoble,nice,lyon,paris"]
    set_temperature_bdd("nice", get_temperature("nice"))

    pass
if __name__ == '__main__':
    main()
# Fin

#! /usr/bin/python
# Written by Dan Mandle http://dan.mandle.me September 2012
# License: GPL 2.0

import os
from gps import *
from time import *
import time
import threading

gpsd = None #seting the global variable

os.system('clear') #clear the terminal (optional)

#Configuration globale
temps_pause = 4 #Temps de pause entre chaque analyse et envoi
adresse_systeme = "http://192.168.1.5/divers/balise_gps/send.php" # Adresse d'envoi des informations GPS


class GpsPoller(threading.Thread):
  def __init__(self):
    threading.Thread.__init__(self)
    global gpsd #bring it in scope
    gpsd = gps(mode=WATCH_ENABLE) #starting the stream of info
    self.current_value = None
    self.running = True #setting the thread running to true

  def run(self):
    global gpsd
    while gpsp.running:
      gpsd.next() #this will continue to loop and grab EACH set of gpsd info to clear the buffer

if __name__ == '__main__':
  gpsp = GpsPoller() # create the thread
  try:
    gpsp.start() # start it up
    while True:
      #It may take a second or two to get good data
      #print gpsd.fix.latitude,', ',gpsd.fix.longitude,'  Time: ',gpsd.utc

      os.system('clear')

      print
      print ' GPS reading'
      print '----------------------------------------'
      print 'latitude    ' , gpsd.fix.latitude
      print 'longitude   ' , gpsd.fix.longitude
      print 'time utc    ' , gpsd.utc,' + ', gpsd.fix.time
      print 'altitude (m)' , gpsd.fix.altitude
      print 'eps         ' , gpsd.fix.eps
      print 'epx         ' , gpsd.fix.epx
      print 'epv         ' , gpsd.fix.epv
      print 'ept         ' , gpsd.fix.ept
      print 'speed (m/s) ' , gpsd.fix.speed
      print 'climb       ' , gpsd.fix.climb
      print 'track       ' , gpsd.fix.track
      print 'mode        ' , gpsd.fix.mode
      print
      print 'sats        ' , gpsd.satellites
      print '----------------------------------------'
      print 'Send datas'
      
      if(gpsd.fix.latitude > 0):
		# Definition de l'adresse URL
		url = adresse_systeme + "?lat=" + str(gpsd.fix.latitude) + "&long=" + str(gpsd.fix.longitude) + "&altitude=" + str(gpsd.fix.altitude) + "&speed=" + str(gpsd.fix.speed)
      
		# Affichage de l'URL
		print 'URL de destination : ' + url

		# Envoi des donnees
		os.system('php open_url.php "' + url + '"');

      else:
		print "Datas cannot be sent because there was an error."

      time.sleep(temps_pause) #set to whatever

  except (KeyboardInterrupt, SystemExit): #when you press ctrl+c
    print "\n Arret en cours du service GPS, veuillez patienter..."
    gpsp.running = False
    gpsp.join() # wait for the thread to finish what it's doing
  print "Done.\nExiting."

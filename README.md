# PHP GPS Location Plotter
GPS Location Plotter for PHP using Open Maps and leafletjs.com
  
> This project was a simple implementation to bypass paying for Google Maps, i found a great implementation for JavaScript and converted it into a PHP HTML generator. All credits go to leafletjs.com and Open Maps for their Implementations.   
   
### What Is This ?     
The PHP GPS Location Plotter,     
This project aims to take a simple GET or POST request and convert that request into a map with plotted Locations.    
    
I wanted to be able to send a simple GET request to the API and it return a simple map with the GPS coordinates marked, i especially needed it to allow multiple locations on a single map.

### Demo    
[![demo button](https://i.imgur.com/3Ugm8J7.jpg)](https://gps-plotter.herokuapp.com?showPath=true&showArea=true&zoom=12&locations=55.05,-0.09,1,Test%201|55.04,-0.09,8,Test%202|55.02,-0.04,4,Test%203) 
       

![screen](Screenshot_20211031_054929.jpg)
     
---    

### How To Install ?   
- Get MAP Tiles Token : https://www.mapbox.com/studio/account/tokens/      
- Add Token to Index.php
- Copy to PHP Server     
    
#### Quick Deployment    
• Create a FREE account first if you do not yet have one:      
 https://signup.heroku.com/         
    
• Deploy To Heroku     
[![Deploy](https://www.herokucdn.com/deploy/button.svg)](https://heroku.com/deploy)
  
### How To Use  ?
Send a GET or POST request to your script with the following parameters,    
     
`showPath=true` or `false`      
`showArea=true` or `false` - requires `showPath=true`    
`zoom=1` from `1` to `20` zoom level ( 1 being the highest altitude )      
`locations=51.5,-0.08,20,Example`  or multiple locations seperated by "|"    
   
  
The locations parameter needs to be formatted as follows,     
>Lattitude , Longitude , Radius in Metres , Url Encoded Title    
   
Example GET Request,    
`index.php?locations=55.05,-0.09,1,Test%201|55.04,-0.09,8,Test%202|55.02,-0.04,400,Test%203`

      
The URL Encoded Title can include HTML for styling the information returned in the pop-up   
  
Complete Example URL,       
https://gps-plotter.herokuapp.com/?showPath=true&showArea=true&zoom=12&locations=55.05,-0.09,1,Test%201%7C55.04,-0.09,8,Test%202%7C55.02,-0.04,4,Test%203
   

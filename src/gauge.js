const tempElement = document.querySelector(".gauge.gauge-temp");
const humidElement = document.querySelector(".gauge.gauge-humid");


function setTempValue(gauge, temp) {
  if (temp < 0 || temp > 1024) {
    return;
  }

  gauge.querySelector(".gauge__fill_temp").style.transform = `rotate(${
    temp / 2
  }turn)`;
  gauge.querySelector(".gauge__cover_temp").textContent = `${Math.round(
    temp * 100
  )}%`;

}


function setHumidValue(gauge, humid) {
    if (humid < 0 || humid > 1024) {
      return;
    }
  
    gauge.querySelector(".gauge__fill_humid").style.transform = `rotate(${
      humid / 2
    }turn)`;
    gauge.querySelector(".gauge__cover_humid").textContent = `${Math.round(
      humid * 100
    )}%`;
  }

setTempValue(tempElement, 0.1);
setHumidValue(humidElement, 0.8);
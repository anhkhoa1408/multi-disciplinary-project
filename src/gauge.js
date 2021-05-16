function setTempValue(gauge, temp) {
  if (temp < 0 || temp > 100) {
    return;
  }

  gauge.querySelector(".gauge__fill_temp").style.transform = `rotate(${temp / (2 * 100)
    }turn)`;
  gauge.querySelector(".gauge__cover_temp").textContent = `${Math.round(
    temp
  )}`;

}

function setHumidValue(gauge, humid) {
  if (humid < 0 || humid > 1023) {
    return;
  }

  gauge.querySelector(".gauge__fill_humid").style.transform = `rotate(${humid / (2 * 1024)
    }turn)`;
  gauge.querySelector(".gauge__cover_humid").textContent = `${Math.round(
    humid
  )}`;
}

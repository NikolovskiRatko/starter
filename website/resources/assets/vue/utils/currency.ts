function toCurrency(value: string | number)  {
  if (typeof value !== "number") {
    return value;
  }
  var formatter = new Intl.NumberFormat('de-DE', {
    style: 'currency',
    currency: 'EUR',
    minimumFractionDigits: 0
  });

  return formatter.format(value);
}

export { toCurrency };

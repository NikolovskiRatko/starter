import { addYears, format } from 'date-fns';

// tslint:disable: prefer-template

function formatDateSimple(date: Date, formatPattern: string) : string {
  if (date) {
    const d = toDate(date);
    const month = d.getMonth() < 9 ? '0' + (d.getMonth() + 1) : '' + (d.getMonth() + 1);
    const day = '' + d.getDate();
    const year = (d.getFullYear() + '').substring(2);
    const full_year = '' + d.getFullYear();

    let format = formatPattern.replace('dd', (d.getDate() < 10) ? '0' + day : day);
//    format = format.replace('d', day);
    format = format.replace('MM', month);
//    format = format.replace(/M(?![ao])/, '' + (d.getMonth() + 1));
    format = format.replace('yyyy', full_year);
//    format = format.replace('YYYY', full_year);
    format = format.replace('yy', year);
//    format = format.replace('YY', year);

    return format;
  }
  return '';
}

function formatDate_DDMMYYYY(date: Date) {
  if (date) {
    const d = toDate(date);
    const month = d.getMonth() < 9 ? '0' + (d.getMonth() + 1) : (d.getMonth() + 1);
    const day = (d.getDate() < 10) ? '0' + d.getDate() : d.getDate();
    const year = d.getFullYear();

    return day + '.' + month + '.' + year;
  }
}

function toDate(date: Date | string | number) {
  const argStr = Object.prototype.toString.call(date);

  // Clone the date
  if (
    date instanceof Date ||
    (typeof date === 'object' && argStr === '[object Date]')
  ) {
    // Prevent the date to lose the milliseconds when passed to new Date() in IE10
    return new Date(date.getTime());
  } else if (typeof date === 'number' || argStr === '[object Number]') {
    return new Date(date);
  } else {
    if (
      (typeof date === 'string' || argStr === '[object String]') &&
      typeof console !== 'undefined'
    ) {
      return new Date(date);
    }
    console.log('Wrong date format: ' + date);
    return new Date(NaN);
  }
}

function formatDate(date: Date | string | number, formatStr: string) {
  if (date) {
    const d = toDate(date);
    if (!isNaN(d as any)) {
      return format(d, formatStr);
    } else {
      return date;
    }
  }
}

function differenceInMilliseconds(
  dateLeft: Date,
  dateRight: Date
) {
  if (arguments.length < 2) {
    throw new TypeError(
      '2 arguments required, but only ' + arguments.length + ' present'
    )
  }

  return dateLeft.getTime() - dateRight.getTime();
}

export { formatDate, formatDateSimple, formatDate_DDMMYYYY, addYears, differenceInMilliseconds };

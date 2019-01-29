// var picked_result = '[data-calendar-label="picked"]';
//var picked_result = '[id="t-0000"]';

function createCalendarVanilla(output, div, callback){
  var html = "";
  // var div_base = div;
  // div = div+getMilli();
  html += '<div id="v-cal">';
  html += '<div class="vcal-header">';
  html += '<button class="vcal-btn" data-calendar-toggle="previous_'+ div +'">';
  html += '<svg height="24" version="1.1" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">';
  html += '<path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"></path>';
  html += '</svg>';
  html += '</button>';
  html += '<div class="vcal-header__label" data-calendar-label="month_'+ div +'">';
  html += 'March 2017';
  html += '</div>';
  html += '<button class="vcal-btn" data-calendar-toggle="next_'+ div +'">';
  html += '<svg height="24" version="1.1" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">';
  html += '<path d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"></path>';
  html += '</svg>';
  html += '</button>';
  html += '</div>';
  html += '<div class="vcal-week">';
  html += '<span>L</span>';
  html += '<span>M</span>';
  html += '<span>M</span>';
  html += '<span>J</span>';
  html += '<span>V</span>';
  html += '<span>S</span>';
  html += '<span>D</span>';
  html += '</div>';
  html += '<div class="vcal-body" id ="month_'+ div +'" data-calendar-area="month_'+ div +'"></div>';
  html += '</div>';


  // date: new Date(),
  // todaysDate: new Date(), todaysDate: new Date('October 10, 2020')

  document.getElementById(div).innerHTML = html;
 
  var picked_result = '['+ output +']';
  var vanillaCalendar = {
    month: document.querySelectorAll('[data-calendar-area="month_'+ div +'"]')[0],
    next: document.querySelectorAll('[data-calendar-toggle="next_'+ div +'"]')[0],
    previous: document.querySelectorAll('[data-calendar-toggle="previous_'+ div +'"]')[0],
    label: document.querySelectorAll('[data-calendar-label="month_'+ div +'"]')[0],
    activeDates: null,
    date: new Date(),
    todaysDate: new Date(),
  
    init: function (options) {
      this.options = options
      if (options.new_date) {
        if (options.new_date == ''){
          this.date =  new Date()
          this.todaysDate = new Date()
        } else {
          this.date =  new Date(options.new_date)
          this.todaysDate = new Date(options.new_date)
        }
      } else {
        this.date =  new Date()
        this.todaysDate = new Date()
      }
     
      this.date.setDate(1)
      this.createMonth()
      this.createListeners()
     
    },
  
    createListeners: function () {
      var _this = this
      this.next.addEventListener('click', function () {
        _this.clearCalendar()
        var nextMonth = _this.date.getMonth() + 1
        _this.date.setMonth(nextMonth)
        _this.createMonth()
      })
      // Clears the calendar and shows the previous month
      this.previous.addEventListener('click', function () {
        _this.clearCalendar()
        var prevMonth = _this.date.getMonth() - 1
        _this.date.setMonth(prevMonth)
        _this.createMonth()
      })
    },
  
    createDay: function (num, day, year) {
      var newDay = document.createElement('div')
      var dateEl = document.createElement('span')
      dateEl.innerHTML = num
      newDay.className = 'vcal-date'
      newDay.setAttribute('data-calendar-date', this.date.getFullYear() + "-" + (this.date.getMonth()+1) + "-" + this.date.getDate())
  
      // if it's the first day of the month
      if (num === 1) {
        if (day === 0) {
          newDay.style.marginLeft = (6 * 14.28) + '%'
        } else {
          newDay.style.marginLeft = ((day - 1) * 14.28) + '%'
        }
      }
  
      if (this.options.disablePastDays && this.date.getTime() <= this.todaysDate.getTime() - 1) {
        newDay.classList.add('vcal-date--disabled')
      } else {
        newDay.classList.add('vcal-date--active')
        newDay.setAttribute('data-calendar-status_'+div, 'active')
      }
  
      if (this.date.toString() === this.todaysDate.toString()) {
        newDay.classList.add('vcal-date--today')
      }
  
      newDay.appendChild(dateEl)
      this.month.appendChild(newDay)
    },
  
    dateClicked: function () {
      var _this = this
      this.activeDates = document.querySelectorAll(
        '[data-calendar-status_'+div+'="active"]'
      )
      for (var i = 0; i < this.activeDates.length; i++) {
        this.activeDates[i].addEventListener('click', function (event) {
          var picked = document.querySelectorAll(
            picked_result
          )[0]
          picked.value = this.dataset.calendarDate
          _this.removeActiveClass()
          this.classList.add('vcal-date--selected')
          var fn = window[callback];
          fn(this.dataset.calendarDate);
        })
      }
    },
  
    createMonth: function () {
      var currentMonth = this.date.getMonth()
      while (this.date.getMonth() === currentMonth) {
        this.createDay(
          this.date.getDate(),
          this.date.getDay(),
          this.date.getFullYear()
        )
        this.date.setDate(this.date.getDate() + 1)
      }
      // while loop trips over and day is at 30/31, bring it back
      this.date.setDate(1)
      this.date.setMonth(this.date.getMonth() - 1)
  
      this.label.innerHTML =
        this.monthsAsString(this.date.getMonth()) + ' ' + this.date.getFullYear()
      this.dateClicked()
    },
  
    monthsAsString: function (monthIndex) {
      return [
        'Enero',
        'Febrero',
        'Marzo',
        'Abril',
        'Mayo',
        'Junio',
        'Julio',
        'Agosto',
        'Septiembre',
        'Octubre',
        'Noviembre',
        'Diciembre'
      ][monthIndex]
    },
  
    clearCalendar: function () {
      vanillaCalendar.month.innerHTML = ''
    },
  
    removeActiveClass: function () {
      for (var i = 0; i < this.activeDates.length; i++) {
        this.activeDates[i].classList.remove('vcal-date--selected')
      }
    }
  }

  return vanillaCalendar;
}


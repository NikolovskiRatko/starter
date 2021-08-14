<script lang="ts">
  import { DialogComponent } from 'vue-modal-dialogs';
  import { Component, Prop, Vue } from 'vue-property-decorator';
  import { format , startOfMonth , getDay , addDays , isToday , isTomorrow , isYesterday , isSameDay , isSameMonth , lastDayOfMonth , eachDayOfInterval , addMonths , setMonth , getMonth , isPast , subDays } from "date-fns/esm/index";

  import DatepickerConst from "@/config/constants/Datepicker";

  @Component({
    filters : {
      formatDateToDay(val) {
        return format(val, 'd');
      }
    }
  })

  export default class ModernDatepicker extends Vue {

    today : Date = new Date();
    dayLabels : Array<any> = DatepickerConst.DAY_LABELS;
    selectedDate : Date = new Date();
    currDateCursor : Date = new Date();

    isSliding : boolean = false;

    dragging: boolean = false;
    x: any = 'no';
    y: any = 'no';

    initX: any = 'no';
    draggedLength: number = 0;

    wrapStyle : object = {
      'left' : (100 / 7) * 3 * -1 + '%',
      'transition' : 'none',
    };

    get currentMonth() {
      return this.currDateCursor.getMonth();
    }

    get currentYear() {
      return this.currDateCursor.getFullYear();
    }

    get currentMonthLabel() {
      return DatepickerConst.MONTH_LABELS[this.currentMonth];
    }

    get classicDates() {
      const cursorDate = this.currDateCursor;

      let startDate = startOfMonth(cursorDate),
        endDate = lastDayOfMonth(cursorDate);

      const daysNeededForLastMonth = getDay(startDate),
        daysNeededForNextMonth = (7 - (getDay(endDate) + 1)) > 6 ? 0 : (7 - getDay(endDate)) - 1;

      startDate = addDays(startDate, -daysNeededForLastMonth);
      endDate = addDays(endDate, daysNeededForNextMonth);

      return eachDayOfInterval({ start: startDate, end: endDate }).map(date => ({
        date,
        isCurrentMonth:  isSameMonth(cursorDate, date),
        isToday: isToday(date),
        isSelected: isSameDay(this.selectedDate, date),
        isInPast: isPast(date),
      }))
    }

    get modernDates() {
      const cursorDate = this.selectedDate;

      let startDate = subDays(cursorDate,6),
        endDate = addDays(cursorDate,6);

      // const daysNeededForLastMonth = getDay(startDate),
      //       daysNeededForNextMonth = (7 - (getDay(endDate) + 1)) > 6 ? 0 : (7 - getDay(endDate)) - 1;
      //
      // startDate = addDays(startDate, -daysNeededForLastMonth);
      // endDate = addDays(endDate, daysNeededForNextMonth);

      return eachDayOfInterval({ start: startDate, end: endDate }).map(date => ({
        date,
        isCurrentMonth: isSameMonth(cursorDate, date),
        isToday: isToday(date),
        isSelected: isSameDay(this.selectedDate, date),
        isInPast: isPast(date),
        isNextDay: isSameDay(date, addDays(this.selectedDate,1)),
        isPreviousDay: isSameDay(date, subDays(this.selectedDate,1)),
        dayInWeek: getDay(date),
      }))
    }

    classicDayClassObj(day) {
      return {
        'sk-calendar-classic__day-value--today' : day.isToday,
        'sk-calendar-classic__day-value--current': day.isCurrentMonth,
        'sk-calendar-classic__day-value--selected': day.isSelected,
      };
    }

    modernDayClassObj(day) {
      return {
        'sk-calendar-modern__day--today' : day.isToday,
        'sk-calendar-modern__day--current': day.isCurrentMonth,
        'sk-calendar-modern__day--selected': day.isSelected,
        'sk-calendar-modern__day--next': day.isNextDay,
        'sk-calendar-modern__day--previous': day.isPreviousDay,
      };
    }

    nextMonth() {
      this.currDateCursor = addMonths(this.currDateCursor, 1);
    }

    previousMonth() {
      this.currDateCursor = addMonths(this.currDateCursor, -1);
    }

    nextDay() {
      // this.selectedDate = addDays(this.selectedDate, 1);
      this.animateLeft(1);
    }

    animateLeft(days) {
      this.wrapStyle.left = ((100 / 7) * 3 * -1) + ((100 / 7) * days * -1) + '%';
      this.wrapStyle.transition = 'left 0.2s linear';
      this.isSliding = true;
      setTimeout(()=>{
        this.isSliding = false;
        this.wrapStyle.left = (100 / 7) * 3 * -1 + '%';
        this.wrapStyle.transition = 'none';
        this.selectedDate = addDays(this.selectedDate, 1);
      },200);
    }


    previousDay() {
      this.selectedDate = subDays(this.selectedDate, 1);
    }

    setSelectedDate(day) {
      this.selectedDate = day.date;
      this.$emit('input', this.selectedDate);
      // change calendar to correct month if they select previous or next month's days
      if (!day.isCurrentMonth) {
        const selectedMonth = getMonth(this.selectedDate);
        this.currDateCursor = setMonth(this.currDateCursor, selectedMonth);
      }
    }

    startDrag(event) {
      this.dragging = true;
      this.x = this.y = 0;
      this.initX = event.clientX;
      // console.log('Start');
    }

    stopDrag() {
      this.dragging = false;
      this.x = this.y = this.initX = 'no';
    }

    doDrag(event) {
      if (this.dragging) {
        this.x = event.clientX;
        this.y = event.clientY;
        // console.log('Do Drag');
        // console.log(this.x);
        this.calculateDraggedLength(event);
      }
    }

    calculateDraggedLength(e) {
      let wrapSize = this.$refs.calendarModernInner.getBoundingClientRect();
      this.draggedLength = (e.clientX - this.initX);

      console.log(this.percentage(this.draggedLength, wrapSize.width)+'%');

      this.wrapStyle.left = ((100 / 7) * 3 * -1) + this.percentage(this.draggedLength, wrapSize.width) + '%';
    }

    percentage(partialValue, totalValue) {
      return (100 * partialValue) / totalValue;
    }

    mounted() {
      if (this.value) {
        this.currDateCursor = this.value;
        this.selectedDate = this.value;
      }

      window.addEventListener('mouseup', this.stopDrag);
    }
  }
</script>

<template>

  <div class="sk-calendar-modern">

    <span>{{draggedLength}}</span>
    <span>{{wrapStyle.left}}</span>
    <div class="sk-calendar-modern__days-container">

      <button @click="previousDay" class="sk-calendar-classic__arrow">
        <i class="fa fa-chevron-left"></i>
      </button>

      <div class="sk-calendar-modern__days-inner"
           @mousedown="startDrag"
           @mousemove="doDrag"
           ref="calendarModernInner">

        <div class="sk-calendar-modern__days-wrap"
             :class="{
              'sk-calendar-modern__days-wrap--sliding' : isSliding,
             }"
             :style="wrapStyle">

          <span v-for="(day, index) in modernDates"
                class="sk-calendar-modern__day"
                :class="modernDayClassObj(day)">
            <span class="sk-calendar-modern_day_name">
              {{ dayLabels[day.dayInWeek] }}
            </span>
            <span class="sk-calendar-modern_day_date">
              {{ day.date | formatDateToDay }}
            </span>
          </span>

        </div>

      </div>

      <button @click="nextDay" class="sk-calendar-classic__arrow">
        <i class="fa fa-chevron-right"></i>
      </button>

    </div>

  </div>
</template>

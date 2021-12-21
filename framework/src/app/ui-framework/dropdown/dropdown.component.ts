import { Component, OnInit, ViewChild } from '@angular/core';
import { ListItem } from 'projects/dashboard-ui-framework/src/lib/models/models';
import { CustomDropdownComponent } from 'projects/dashboard-ui-framework/src/public-api';

@Component({
  selector: 'app-dropdown',
  templateUrl: './dropdown.component.html',
  styleUrls: ['./dropdown.component.scss']
})
export class DropdownComponent implements OnInit {
  // @ViewChild('simpleDropdown', { static: false }) simpleDropdown: CustomDropdownComponent;
  // @ViewChild('simpleDropdownError', { static: false }) simpleDropdownError: CustomDropdownComponent;
  // @ViewChild('simpleDropdownPacific', { static: false }) simpleDropdownPacific: CustomDropdownComponent;
  data: Array<ListItem> = [];
  linkData: Array<ListItem> = [];
  multidata: Array<{ title: string, items?: Array<ListItem> }> = [];
  values: any;
  constructor() { }

  ngOnInit() {
    this.data.push(
      { id: '1', text: 'something', disabled: true, checked: false },
      { id: '2', text: 'ankit 1', disabled: false, checked: false },
      { id: '3', text: 'Ankit  2', disabled: false, checked: false },
      { id: '4', text: 'akash 3', disabled: false, checked: false },
      { id: '5', text: 'neew 4', disabled: false, checked: false });
    this.linkData.push({ id: 'njcsa', text: 'Link 1' },
      { id: 'njcsa', text: 'Link 1', showLinkTextOnClick: true });
    this.multidata.push({
      title: 'Contact List', items: [
        { id: '2', text: 'list 1', disabled: false, checked: true },
        { id: '3', text: 'list  TESTTTTT', disabled: false, checked: false },
        { id: '4', text: 'list 3', disabled: false, checked: true },
        { id: '5', text: 'list 4', disabled: false, checked: false }]
    },
      {
        title: 'Contacts', items: [
          { id: '2', text: 'ankit 1', disabled: false, checked: false },
          { id: '3', text: 'Ankit  2', disabled: false, checked: true },
          { id: '4', text: 'akash 3', disabled: false, checked: false },
          { id: '5', text: 'neew 4', disabled: false, checked: false }]
      })
    setTimeout(() => {
      this.multidata[0].items[1].checked = true;
    }, 5000);
  }

  OnSelectItem(event) {
    console.log(event);
  }

  OnSelectLink(event) {
    console.log(event);
  }

  checkValueChange() {
    console.log(this.values);
  }

}

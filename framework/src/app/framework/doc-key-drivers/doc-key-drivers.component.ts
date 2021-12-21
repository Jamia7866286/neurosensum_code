import { Component, OnInit } from '@angular/core';
import { variable } from '@angular/compiler/src/output/output_ast';
import { KeyDriversInfo, FilterConfig } from 'projects/dashboard-framework/src/lib/models/model';
// import { DropdownType, ListItem } from 'dashboard-ui-framework/lib/models/models';
import { ListItem, DropdownType } from 'projects/dashboard-ui-framework/src/public-api';

@Component({
  selector: 'app-doc-key-drivers',
  templateUrl: './doc-key-drivers.component.html',
  styleUrls: ['./doc-key-drivers.component.scss']
})
export class DocKeyDriversComponent implements OnInit {
  projectScale: number = 5;
  variables: Array<KeyDriversInfo> = [];
  html = `
  <dashboard-key-drivers [projectScale]="projectScale" [variables]="variables"></dashboard-key-drivers>`
  classes = `
  class KeyDriversInfo {
    questionId: string;
    variableId: string;
    tag: string;
  }`
  constructor() { }
  ngOnInit() {

    let sideBreak = new KeyDriversInfo()
    sideBreak = {
      questionId: '9e05260e-4602-c16e-3ec2-3734e6725c1a',
      variableId: 'vz6',
      color: 'rgb(0, 82, 204)',
      tag: 'Kemudahan Booking'
    };
    this.variables.push(sideBreak);
    sideBreak = new KeyDriversInfo();
    sideBreak = {
      questionId: '097cf04d-ea5e-3f89-f5f6-d90943ba4e89',
      variableId: 'vz7',
      color: 'rgb(0, 135, 90)',
      tag: 'Kemudahan Check-in'
    };
    this.variables.push(sideBreak);

    sideBreak = new KeyDriversInfo()
    sideBreak = {
      questionId: '8e22d464-a69d-0c4b-146f-e5226cfef02f',
      variableId: 'vz9',
      color: 'rgb(9, 30, 66)',
      tag: 'Kebersihan Kamar'
    };
    this.variables.push(sideBreak);
    sideBreak = new KeyDriversInfo()
    sideBreak = {
      questionId: '17b684bc-e8dd-2708-71e1-b83a25de03e0',
      variableId: 'vz11',
      color: 'rgb(64, 50, 148)',
      tag: 'Kebersihan Kamar Mandi'
    };
    this.variables.push(sideBreak);
    sideBreak = new KeyDriversInfo()
    sideBreak = {
      questionId: 'a73a7476-af6b-9039-3d7a-f051e7d8aad5',
      variableId: 'vz13',
      color: 'rgb(222, 53, 11)',
      tag: 'Fasilitas Hotel'
    };
    this.variables.push(sideBreak);

    sideBreak = new KeyDriversInfo()
    sideBreak = {
      questionId: '9dfbeac4-7610-dd7e-22d3-de815d41c6cb',
      variableId: 'vz15',
      color: 'rgb(255, 86, 48)',
      tag: 'Lokasi'
    };
    this.variables.push(sideBreak);

    sideBreak = new KeyDriversInfo()
    sideBreak = {
      questionId: 'e68d643d-0f31-5f69-2964-6a4c5c243e94',
      variableId: 'vz17',
      color: 'rgb(0, 163, 191)',
      tag: 'Keramahan Staf'
    };
    this.variables.push(sideBreak);

    sideBreak = new KeyDriversInfo()
    sideBreak = {
      questionId: 'a624f799-b707-aab6-935b-1e28f20343fa',
      variableId: 'vz19',
      color: 'rgb(255, 139, 0)',
      tag: '6 (Enam) Standar Jaminan RedDoorz'
    };
    this.variables.push(sideBreak);
  }

}

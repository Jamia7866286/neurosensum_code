import { Pipe, PipeTransform } from '@angular/core';
import { ListItem } from '../models/models';

@Pipe({
  name: 'search'
})
export class SearchPipe implements PipeTransform {

  transform(value: Array<ListItem>,searchText: string): any {
    let Arr = value.filter(function(item) {
      return item.text.toLowerCase().includes(searchText.toLowerCase());
    });
    return Arr;
  }

}

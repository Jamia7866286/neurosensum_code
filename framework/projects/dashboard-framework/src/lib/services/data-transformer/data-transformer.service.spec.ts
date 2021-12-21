import { TestBed } from '@angular/core/testing';

import { DataTransformerService } from './data-transformer.service';

describe('DataTransformerService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: DataTransformerService = TestBed.get(DataTransformerService);
    expect(service).toBeTruthy();
  });
});

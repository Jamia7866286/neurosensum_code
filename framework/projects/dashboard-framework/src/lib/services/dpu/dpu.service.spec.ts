import { TestBed } from '@angular/core/testing';

import { DpuService } from './dpu.service';

describe('DpuService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: DpuService = TestBed.get(DpuService);
    expect(service).toBeTruthy();
  });
});

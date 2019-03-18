import { TestBed } from '@angular/core/testing';

import { KtaService } from './kta.service';

describe('KtaService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: KtaService = TestBed.get(KtaService);
    expect(service).toBeTruthy();
  });
});

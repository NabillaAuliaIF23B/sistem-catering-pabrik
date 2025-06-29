import { ComponentFixture, TestBed } from '@angular/core/testing';
import { InputLaporanPage } from './input-laporan.page';

describe('InputLaporanPage', () => {
  let component: InputLaporanPage;
  let fixture: ComponentFixture<InputLaporanPage>;

  beforeEach(() => {
    fixture = TestBed.createComponent(InputLaporanPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

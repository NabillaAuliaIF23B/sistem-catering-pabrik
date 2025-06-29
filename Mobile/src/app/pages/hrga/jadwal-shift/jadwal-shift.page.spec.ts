import { ComponentFixture, TestBed } from '@angular/core/testing';
import { JadwalShiftPage } from './jadwal-shift.page';

describe('JadwalShiftPage', () => {
  let component: JadwalShiftPage;
  let fixture: ComponentFixture<JadwalShiftPage>;

  beforeEach(() => {
    fixture = TestBed.createComponent(JadwalShiftPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

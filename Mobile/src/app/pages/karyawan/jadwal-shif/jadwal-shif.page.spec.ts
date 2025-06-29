import { ComponentFixture, TestBed } from '@angular/core/testing';
import { JadwalShifPage } from './jadwal-shif.page';

describe('JadwalShifPage', () => {
  let component: JadwalShifPage;
  let fixture: ComponentFixture<JadwalShifPage>;

  beforeEach(() => {
    fixture = TestBed.createComponent(JadwalShifPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

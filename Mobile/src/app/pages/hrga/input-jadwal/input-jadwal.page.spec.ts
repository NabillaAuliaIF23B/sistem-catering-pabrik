import { ComponentFixture, TestBed } from '@angular/core/testing';
import { InputJadwalPage } from './input-jadwal.page';

describe('InputJadwalPage', () => {
  let component: InputJadwalPage;
  let fixture: ComponentFixture<InputJadwalPage>;

  beforeEach(() => {
    fixture = TestBed.createComponent(InputJadwalPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
